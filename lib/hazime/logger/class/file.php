<?php
namespace Hazime\Logger;

class File extends Logger{
	private $_fp;

	public function __construct( $file, $open_mode = 'a')
	{
		$this->_fp = fopen( $file, $open_mode);
		register_shutdown_function(array($this,'close'));
	}

	public function close()
	{
		fclose($this->_fp);
	}

	protected function _log( $level, $msg )
	{
		fwrite($this->_fp, sprintf("[%s] %s\n",$this->level($level),$msg));
	}
}
?>

