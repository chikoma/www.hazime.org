<?php
namespace Hazime\Application\Helper;
use Hazime\Application\Bootstrap as HazimeBootstrap;

class Bootstrap extends HazimeBootstrap
{
	private $_bootstrap;
	public function call( $bootstrap = null )
	{
		if( $bootstrap !== null )
		{
			$this->_bootstrap = $bootstrap;
		}
		return $this->_bootstrap;
	}
}
?>
