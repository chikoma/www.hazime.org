<?php
namespace Hazime\Application;

trait AttachHelperBroker 
{
	private $_broker;

	public function setHelperBroker( $broker )
	{
		$this->_broker = $broker;
	}

	public function getHelperBroker( )
	{
		return $this->_broker;
	}

	public function __call( $name, $args )
	{
		return $this->getHelperBroker( )->call($name,$args);
	}
}
?>
