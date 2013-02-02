<?php
namespace Hazime\Helper;

class Broker
{
	private $_caller;
	private $_helpers;

	public function setCaller( $object )
	{
		$this->_caller = $object;
	}

	public function getCaller( )
	{
		return $this->_caller;
	}

	public function copyHelpers( Broker $broker )
	{
		$this->_helpers = $broker->getHelpers();
	}
	public function getHelpers( )
	{
		return $this->_helpers;
	}

	public function addDir( $dir, $ns )
	{
		foreach(glob($dir.'/*.php') as $file  )
		{
			$name = basename($file);
			$name = substr($name,0,strpos($name,'.'));
			$class= $ns.'\\'.ucfirst($name);
			require_once $file;
			$this->set( $name, strtolower($class) );
		}
		return $this;
	}

	public function set( $name, $object )
	{
		$this->_helpers[strtolower($name)] = $object;
		return $this;
	}

	public function get( $name )
	{
		if( isset($this->_helpers[$name]) )
		{
			if(is_string($this->_helpers[$name]))
			{
				$this->_helpers[$name] = new $this->_helpers[$name];
			}
			return $this->_helpers[$name];
		}
		throw new \RuntimeException( 'Helper ['.$name.'] Is Not Found' );
	}

	public function call( $name, $args )
	{
		array_unshift( $args, $this->_caller );
		return call_user_func_array(array($this->get($name),'call'),$args);
	}

}
?>
