<?php
trait Singleton
{
	protected function __construct( ) { }

	static function getInstance( )
	{
		static $obj = null;
		return $obj ?: $obj = new static;
	}

	function __clone( )
	{
		throw new RuntimeException("You can't clone this instance.");
	}
}
?>
