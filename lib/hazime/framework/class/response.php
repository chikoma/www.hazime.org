<?php
namespace Hazime\Framework;
use Hazime\Container\Container;

class Response 
{
	public $info;
	private $_status;

	public function __construct( )
	{
		$this->info = new Container( );
	}

	public function status( $status )
	{
		$this->_status = $status;
	}

}
?>
