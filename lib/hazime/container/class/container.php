<?php
namespace Hazime\Container;

class Container
{
	private $_array = array();

	public function __get( $name )
	{
		return $this->getVar( $name );
	}

	public function __set( $name, $value)
	{
		$this->setVar( $name, $value );
		return $this;
	}

	public function setVars($array)
	{
		foreach( $array as $k=>$v )
		{
			$this->setVar($k, $v);
		}
		return $this;
	}

	public function setVar( $key, $value )
	{
		$this->_array[$key] = $value;
		return $this;
	}

	public function getVar( $key )
	{
		return $this->_array[$key];
	}

	public function getVars( )
	{
		return $this->_array;
	}
}
?>
