<?php
namespace Hazime\Application;
use Hazime\Config\Config;

class Loader
{
	static function load( $dir )
	{
		if( !is_dir($dir) )
		{
			die( $dir . ' is not a directory ');
		}
		$dir = realpath($dir);

		// Config Objectを作成
		$config = new Config( );
		foreach( glob( $dir.'/config/*.conf' ) as $conf )
		{
			// File名をConfig Sectionにするなら
			// $name = substr(basename($conf),0,strlen(basename($conf))-5);
			$name = null;
			$config->loadFile( $conf, $name );
		}
		$config->general->path = $dir;

		$ns = $config->general->namespace;

		// Bootstrapを起動
		if(file_exists($file = $dir.'/bootstrap.php'))
		{
			require_once $file;
			$class = $ns.'\\'.'Bootstrap';
			$bootstrap = new $class( );
		}
		$bootstrap->initResource('config', $config);
		$bootstrap->initResource('app', new Application( $bootstrap ));

		return $bootstrap->app;
	}
}
?>
