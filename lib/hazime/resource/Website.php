<?php
require_once 'trait/Proxy.php';
require_once 'class/Website/Website.php';

class Hazime_Resource_Website
{
	use Proxy;

	public function __construct( )
	{
		$this->proxyFor( new Hazime_Website( ) );
	}
}
?>
