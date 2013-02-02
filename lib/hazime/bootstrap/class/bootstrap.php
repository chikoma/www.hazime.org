<?php
namespace Hazime\Bootstrap;
use Hazime\Logger\Logging;

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
?>
