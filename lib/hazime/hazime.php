<?php
namespace Hazime;
use Hazime\Core\Singleton;
use Hazime\Logger\Logging;

require_once dirname(__FILE__).'/core/trait/singleton.php';
require_once dirname(__FILE__).'/logger/trait/logging.php';

class Hazime 
{
	use Singleton,Logging;
	private $_root_dir;

	public function init( )
	{
		$this->_root_dir = dirname(__FILE__);
	}

	public function register( )
	{
		spl_autoload_register(array($this,'classLoad'));
	}


	/**
	 * Class Auto Loading
	 *
	 * Namespace: Aaa\Bbb\Ccc
	 * Find in : Aaa/Bbb/Ccc/class/
	 * Find in : Aaa/Bbb/Ccc/trait/
	 * Find in : Aaa/Bbb/Ccc/absolute/
	 * Find in : Aaa/Bbb/Ccc/interface//
	 */
	public function classLoad( $name )
	{
		$name = str_replace(__NAMESPACE__,"",$name);
		$path = str_replace('\\','/',$name);
		$path = $this->_root_dir.'/'.strtolower($path).'.php';

		foreach( array('class','trait','absolute','interface') as $type)
		{
			$file = dirname($path).'/'.$type.'/'.basename($path);
			if(file_exists($file)){
				require_once $file;
				return true;
			}
		}
	}
}
?>
