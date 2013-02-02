<?php
namespace Hazime\Core;

class Registry 
{
	static private $_datas = array();

	static public function set( $key, $name )
	{
		self::$_datas[$key] = $name;
	}

	static public function get( $key )
	{
		return self::$_datas[$key];
	}
}
?>
