<?php
namespace Application\Asterisk;
use Hazime\Logger\Logger;

class Bootstrap extends \Hazime\Application\Bootstrap
{
	public function initAMI( )
	{
		$ams = new \Hazime\Asterisk\Manager();
		$ams->setLogger(new Logger());
		$srv = $this->config->server;
		$ams->connect($srv->host,$srv->port,$srv->username,$srv->secret);
		return $ams;
	}


}
?>
