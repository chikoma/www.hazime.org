<?php
namespace Hazime\Framework;
use Hazime\Container\Container;
use Hazime\Helper\Helpable;

class Controller {

	use Helpable;

	const SUCCESS = 'success';
	const INPUT   = 'input';
	const ERROR   = 'error';

	private $_name;
	private $_module_name;

	public function __construct( $front )
	{
		$this->_front = $front;
		$this->info = new Container;
	}

	public function front( )
	{
		return $this->_front;
	}

	public function bootstrap( )
	{
		return $this->_front->bootstrap();
	}

	public function setName( $name )
	{
		$this->_name = $name;
	}

	public function setModuleName( $name )
	{
		$this->_module_name = $name;
	}

	public function preDispatch( )
	{
	}

	public function postDispatch( )
	{
	}

	public function dispatch( $name = 'index' )
	{
		$this->init( );

		// Set Up Response
		// ------------------------
		$res = $this->response();
		$res->info->module_name     = $this->_module_name;
		$res->info->controller_name = $this->_name;
		$res->info->action_name     = $name;
		$this->preDispatch( );

		// Dispatch Action
		// ------------------------
		if(method_exists($this,$method='action'.ucfirst($name)))
		{
			$status = call_user_func(array($this,$method), $req, $res);
			$res->info->status = $status;
		}
		$this->postDispatch( );
		return $res;
	}
}
?>
