<?php
#
# Include Pathを追加
#======================
ini_set(
	'include_path',
	ini_get('include_path')
	.':'
	.$dir = realpath(dirname(__FILE__)."/../") 
);
define('HAZIME_LIB',$dir);
#
# Hazime Class Core
#================
require_once 'trait/Singleton.php';
require_once 'trait/Logging.php';
require_once 'class/Log/Log.php';

class Hazime 
{
	use Singleton,Logging;

	private $_bootstraps = array();

	public function developMode( )
	{
		ini_set('display_errors', 1);
		$this->log(Hazime_Log::INFO, 'Set Develop Mode');
	}

	public function getBootStrap( $name = 'default' )
	{
		require_once 'class/Bootstrap/Bootstrap.php';
		if (isset($this->_bootstraps[$name]))
		{
			return $this->_bootstraps[$name];
		}

		$this->_bootstraps[$name] = new Hazime_Bootstrap();
		$this->_bootstraps[$name]->setLogger($this->_logger);
		return $this->_bootstraps[$name];
	}
}
?>
