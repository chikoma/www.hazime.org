<?php
namespace Hazime\Helper;

trait Helpable
{
	private $_broker;

	public function getHelperBroker( )
	{
		return $this->_broker ?
			$this->_broker:
			$this->_broker = $this->createBroker();
	}

	public function createBroker( )
	{
		$broker = new Broker();
		$broker->setCaller( $this );
		return $broker;
	}

	public function setHelperBroker( HelperBroker $broker )
	{
		$this->_broker = $broker;
	}

	public function copyHelperBroker( HelperBroker $broker )
	{
		$this->getHelperBroker( )->copyHelpers($broker);
	}

	public function __get( $name )
	{
		return $this->getHelperBroker( )->get($name);
	}
	public function __call( $name, $args )
	{
		return $this->getHelperBroker( )->call($name, $args);
	}

}
?>
