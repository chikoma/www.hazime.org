<?php
use Hazime\Framework\Front;
use Hazime\Bootstrap\Bootstrap as Hazime_Bootstrap;
use Hazime\Asterisk\Manager;
use Hazime\Logger\Logger;

class Bootstrap extends Hazime_Bootstrap
{
	/**
	 * For Asterisk Manager Interface
	 */
	public function initAMI( )
	{
		$ams = new Manager();
		// Connect To Asterisk Server
		$ams->connect('phone.hazime.org',5038,'www','deganjue');
		return $ams;
	}


}
?>
