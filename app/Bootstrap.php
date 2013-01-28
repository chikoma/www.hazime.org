<?php
require_once 'class/Bootstrap/Bootstrap.php';
define('APP_DIR',dirname(__FILE__));

class App_Bootstrap extends Hazime_Bootstrap
{
	protected function initWebsite( )
	{
		$website = $this->getResource('website');
		$website->setHtmlDir(APP_DIR.'/html');
		$website->setDesignDir(APP_DIR.'/design');
		$website->setPublicDir(APP_DIR.'/public');
		$website->setLogger($this->logger());
		return $website;
	}
	protected function initLogger( )
	{
		return new Hazime_Log( );
	}
}
?>
