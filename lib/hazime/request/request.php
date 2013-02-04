<?php
namespace Hazime\Request;
use IteratorAggregate,ArrayIterator;

class Request  implements IteratorAggregate
{
	private $_datas;

	public function getIterator( )
	{
		return new ArrayIterator($this->_datas);
	}

	static public function factory( $name )
	{
		$args = array_slice(func_get_args(),1);
		$rc = new \ReflectionClass(__NAMESPACE__.'\\'.$name);
		return $rc->newInstanceArgs($args);
	}

	public function set($k, $v)
	{
		$this->_datas[$k] = $v;
	}

	public function get($k, $default = null)
	{
		return isset($this->_datas[$k]) ? $this->_datas[$k]: $default;
	}

	public function __set($k,$v)
	{
		return $this->set($k,$v);
	}

	public function __get($k)
	{
		return $this->get($k);
	}
	public function __call( $name, $args )
	{
		return $this->get($name, $args[0]);
	}
}

class CLI extends Request
{

}

?>
