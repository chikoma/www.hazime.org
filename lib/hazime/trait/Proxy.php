<?php
trait Proxy
{
	private $_proxy_for = null;

	protected function proxyFor( $object )
	{
		$this->_proxy_for = $object;
	}

	public function __get( $name )
	{
		return $this->_proxy_for->$name;
	}

	public function __set( $name, $value )
	{
		return $this->_proxy_for->$name = $value;
	}

	public function __call( $name, $args )
	{
		return call_user_func_array(array($this->_proxy_for, $name), $args);
		/*
		if( method_exists($this->_proxy_for, $name) ){
			return call_user_func_array(array($this->_proxy_for, $name), $args);
		}
		throw new RuntimeException(get_class($this->_proxy_for).'::'.$name.'dose not exists');
		 */
	}
}
?>
