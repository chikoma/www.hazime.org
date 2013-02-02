<?php
namespace Hazime\Core;

trait Singleton
{
	static private $_instance;

	protected function __construct( )
	{
		$this->init( );
	}

	protected function init( )
	{
	}

	static public function getInstance( )
	{
		return self::$_instance ? self::$_instance:
			self::$_instance = new static;
	}
}
?>
