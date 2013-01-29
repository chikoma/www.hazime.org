<?php
require_once 'trait/Proxy.php';
require_once 'class/Front/Front.php';

class Hazime_Resource_Front
{
	use Proxy;

	public function __construct( )
	{
		$this->proxyFor( new Hazime_Front( ) );
	}
}
?>
