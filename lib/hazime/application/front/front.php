<?php
namespace Hazime\Application\Front;
use Exception;
use Hazime\Config\Config;
use Hazime\Application\Loader as AppLoader;
use Hazime\Request\Request as AppRequest;

class Front
{
	private $_apps = array();
	public function init( $conf )
	{
		$config = new Config( );
		$config->section('general')->dir = realpath(dirname($conf).'/../');
		$config->loadFile($conf);

		if($config->general->get('apps_dir')){
			$dir = dir($path = $config->general->dir.'/'.$config->general->apps_dir);
			while( $file = $dir->read() ){
				if( $file == '.' || $file =='..' ) continue;
				if(is_dir($app_path = $path.'/'.$file)){
					$this->_apps[$file] = $app_path;
				}
			}
		}
		return $this;
	}

	static public function factory( $type, $conf )
	{
		$class = __NAMESPACE__.'\\'.$type;
		$front = new $class();
		return $front->init($conf);
	}

	public function run( )
	{
		global $argv;

		$file = $argv[1];
		if($file == '-'){
			$file = 'php://stdin';
		}

		// Request
		$req = AppRequest::factory('file',$file);
		$parts      = explode('/',$req->url);

		$app_name   = $parts[1];
		$controller = $parts[2];
		$action     = $parts[3];

		// アプリケーションをロードする
		$app = $this->app($app_name);;
		// リクエストをカスケード
		$app->request( $req );
		// アクションのディスパッチ
		$app->action( $action, $controller);
	}

	public function app($name)
	{
		if(isset($this->_apps[$name]))
		{
			if(is_dir($this->_apps[$name]))
			{
				$this->_apps[$name] = AppLoader::load($this->_apps[$name]);
			}
			return $this->_apps[$name];
		}

		throw Exception('Application unreachable');
	}

}
?>
