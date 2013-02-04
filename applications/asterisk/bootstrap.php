<?php
namespace Application\Asterisk;
use Hazime\Logger\Logger;

class Bootstrap extends \Hazime\Application\Bootstrap
{
	public function initAMI( )
	{
		$srv = $this->config->server;
		$ams = new \Hazime\Asterisk\Manager($srv->host,$srv->port,$srv->username,$srv->secret);
		$ams->setLogger(new Logger());
		return $ams;
	}
}
?>
