<?php
namespace Hazime\Framework;
use Hazime\Logger\Logging;
use Hazime\Core\Configure;
use Hazime\Helper\Helpable;
use Hazime;

class Front
{
	const DEFAULT_MODULE='home';

	use Logging,Configure,Helpable;

	private $_modules;
	private $_bootstrap;

	// For Helper
	public function call( )
	{
		return $this;
	}

	public function __construct( \Bootstrap\Bootstrap $bootstrap )
	{
		$this->_bootstrap = $bootstrap;
		$broker = $this->getHelperBroker();
		$broker->setCaller( $this );
		$broker->addDir(dirname(__FILE__).'/../helper','Hazime\\Framework\\Helper');
	}

	public function bootstrap( ){
		return $this->_bootstrap;
	}

	public function setModuleDir( $dir, $mod_name = self::DEFAULT_MODULE )
	{
		$this->info('set module dir %s', $dir);
		$this->_modules[$mod_name] = $dir;
		return $this;
	}

	public function getModuleDir( $module_name ){
		return $this->_modules[$module_name];
	}

	protected function getController( $ctrl_name, $mod_name = self::DEFAULT_MODULE )
	{
		$mod_dir = $this->_modules[$mod_name];
		$ctrl_file = $mod_dir . '/controller/'.$ctrl_name.'.php';
		if(file_exists($ctrl_file)){
			require_once $ctrl_file;
			$class = "App\\$mod_name\\".$ctrl_name.'Controller';
			$ctrl = new $class( $this );
			$ctrl->setName( $ctrl_name );
			$ctrl->setModuleName( $mod_name );
			//$ctrl->copyHelperBroker( $this->getHelperBroker() );
			$ctrl->setHelperBroker( $this->getHelperBroker() );
			return $ctrl;
		}
		$this->error("can't find controller %s:%s", $mod_name, $ctrl_name );
	}

	public function run( )
	{
		$this->request->setVars($_POST)->setVars($_GET);

		// アクションを実行してレスポンスを取得
		$res = $this->action( $_GET['a'],$_GET['c'],$_GET['m']);

		// レスポンスから画面を表示
		$this->view()->display( $res );
	}

	/**
	 * Dispatch Action
	 */
	public function action( $act_name, $ctrl_name = 'index', $mod_name = self::DEFAULT_MODULE )
	{
		if(empty($act_name)) $act_name = 'index';
		if(empty($ctrl_name)) $ctrl_name = 'index';
		if(empty($mod_name)) $mod_name = self::DEFAULT_MODULE;
		$this->debug('m:%s c:%s a:%s', $mod_name,$ctrl_name,$act_name);
		$c = $this->getController( $ctrl_name, $mod_name );
		return $c->dispatch($act_name);
	}
}
?>
