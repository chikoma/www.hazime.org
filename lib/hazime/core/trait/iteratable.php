<?php
namespace Hazime\Core;

trait Iteratable
{
	private $_datas;

	public function setIteratableArray($datas)
	{
		$this->_datas = $datas;
	}

	public function rewind()
	{
		reset($this->_datas);
	}

	public function current()
	{
		$var = current($this->_datas);
		return $var;
	}

	public function key() 
	{
		$var = key($this->_datas);
		return $var;
	}

	public function next() 
	{
		$var = next($this->_datas);
		return $var;
	}

	public function valid()
	{
		$key = key($this->_datas);
		$var = ($key !== NULL && $key !== FALSE);
		return $var;
	}
}
?>
