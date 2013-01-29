<?php
require_once 'class/Bootstrap/Bootstrap.php';
define('APP_DIR',dirname(__FILE__));

class App_Bootstrap extends Hazime_Bootstrap
{
	protected function initWebsite( )
	{
		$website = $this->getResource('website');
		$website->init(array(
			'template_dir'=>APP_DIR.'/html',
			'design_dir'=>APP_DIR.'/design',
			'public_dir'=>APP_DIR.'/public'
		));
		$website->setLogger($this->logger());
		return $website;
	}
	protected function initLogger( )
	{
		return new Hazime_Log( );
	}
}
?>
