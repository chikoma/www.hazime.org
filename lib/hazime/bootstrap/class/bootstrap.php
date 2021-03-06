<?php
/**
 * Bootstrap
 * ================
 * 
 * リソース管理用のクラス
 * 原理:
 *
 * getResource( $resource )
 * setResource( $name, $class )
 * initResource( $name, $class )
 *
 */
namespace Hazime\Bootstrap;
use Hazime\Logger\Logging;
use Exception;

class Bootstrap
{
	private $_resource = array();
	public function initResource( $name, $object)
	{
		if($this->_hasInitMethod($name)){
			$this->_init($name, $object );
		}else{
			$this->setResource($name, $object);
		}
	}
	public function setResource($name, $object)
	{
		$this->_resource[$name] = $object;
	}

	public function getResource($name)
	{
		if(isset($this->_resource[$name])){
			if(is_string($this->_resource[$name])){
				$class = $this->_resource[$name];
				$this->setResource($name, new $class());
			}
			return $this->_resource[$name];
		}elseif($this->_hasInitMethod($name)){
			return $this->_init($name);
		}else{
			throw new Exception('Resource Not Found'." $name ");
		}
	}
	private function _hasInitMethod($name)
	{
		return method_exists($this,'init'.$name);
	}

	private function _init( $name, $object = null )
	{
		return call_user_func( array($this,'init'.$name), $object );
	}

	public function __get($name)
	{
		return $this->getResource($name);
	}

	public function __set($name, $value)
	{
		$this->setResource($name, $value);
	}

}

/*

class Bootstrap
{
	use Logging;
	private $_resource = array();

	public function __construct( )
	{
		$this->addResourceDir(
			realpath(dirname(__FILE__).'/../resource')
		);
	}

	public function __get( $name ){
		return $this->getResource( $name );
	}

	public function getResource( $name )
	{
		if( isset($this->_resource[$name]) && is_object($this->_resource[$name]) ){
			return$this->_resource[$name];
		}
		return $this->_resource[$name] = $this->createResource($name);
	}

	public function createResource( $name )
	{
		if(method_exists($this,$func = 'init'.$name)){
			return call_user_func(array($this,$func));
		}elseif( is_string($this->_resource[$name]) ){
			return new $this->_resource[$name]( $this );
		}
	}

	public function addResourceDir( $dir, $namespace = null )
	{
		foreach(glob($dir."/*.php") as $file )
		{
			require_once $file;
			$name = str_replace('.php','',basename($file));
			$namespace = $namespace == null? __NAMESPACE__ .'\Resource': $namespace;
			$class = $namespace . '\\'.ucfirst($name);
			$this->addResource($name, $class);
		}
	}

	public function addResource($name, $class)
	{
		return $this->_resource[$name] = $class;
	}
}
 */
?>
