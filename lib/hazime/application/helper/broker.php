<?php
namespace Hazime\Application\Helper;
use Exception;

class Broker
{
	private $_helper = array();

	public function set( $name, $class )
	{
		$this->_helper[$name] = $class;
	}

	public function get( $name )
	{
		if( isset($this->_helper[$name]) )
		{
			if(is_string($this->_helper[$name])){
				$class = $this->_helper[$name];
				$this->_helper[$name] = new $class();
			}
			return $this->_helper[$name];
		}
		throw new Exception('Helper Not Registerd');
	}

	public function call( $name, $args )
	{
		return call_user_func_array(array($this->get($name),'call'),$args);
	}


}
?>
