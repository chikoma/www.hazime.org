<?php
require_once 'trait/Proxy.php';
require_once 'class/View/View.php';

class Hazime_Resource_View
{
	use Proxy;

	public function __construct( )
	{
		$this->proxyFor( new Hazime_View( ) );
	}
}
?>
