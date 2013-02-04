<?php
namespace Hazime\Application;

class Application
{
	const DEFAULT_CTRL = 'home';
	use AttachHelperBroker;

	private $_bootstrap;

	public function __construct( Bootstrap $bs )
	{
		$this->_bootstrap = $bs;

		$this->setHelperBroker( $this->_bootstrap->helperBroker );
	}

	public function bootstrap( )
	{
		return $this->_bootstrap;
	}

	public function config( )
	{
		return $this->bootstrap( )->config;
	}

	public function controller( $name )
	{
		$file = $this->loadFile( 'controller', "$name.php");
		$class = $this->config()->general->namespace . '\\Controller\\'.ucfirst($name);
		$ctrl = new $class( $this );

		return $ctrl;
	}

	public function loadFile( $path, $file )
	{
		$file = $this->path($path).'/'.$file;
		if(file_exists($file)){
			require_once $file;
		}
	}

	public function path( $path )
	{
		$new_path = realpath($this->config( )->general->path);
		$new_path.= '/'.$path;
		return realpath($new_path);
	}

	public function action( $act_name, $ctrl_name = self::DEFAULT_CTRL)
	{
		// コントローラを作成
		$ctrl = $this->controller( $ctrl_name );

		// Dispatch
		$ctrl->dispatch( $act_name );
	}

}
?>

