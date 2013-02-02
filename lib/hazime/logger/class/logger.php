<?php
namespace Hazime\Logger;

class Logger{

	const DEBUG = 1;
	const INFO = 2;
	const NOTICE = 4;
	const WARN = 8;
	const ERROR = 16;
	const ALL = 31;

	private $_reporting_level = 31;

	public function log($level, $msg)
	{
		if( $level & $this->_reporting_level ){
			$this->_log( $level, $msg );
		}
	}

	protected function _log( $level, $msg )
	{
		echo sprintf('[%s] %s<br />',
			$this->level($level),
			$msg
		);
	}

	public function level($level)
	{
		switch($level){
		case self::DEBUG:
			return 'debug';
			break;
		case self::INFO:
			return 'info';
			break;
		case self::NOTICE:
			return 'notice';
			break;
		case self::WARN:
			return 'warn';
			break;
		case self::ERROR:
			return 'error';
			break;
		default:
			return 'unknown('.$level.')';
			break;
		}
	}

	static public function getLogger( $type )
	{
		$args = array_slice(func_get_args(),1);
		$class =  $type;
		$rc = new \ReflectionClass(__NAMESPACE__.'\\'.$type);
		return $rc->newInstanceArgs($args);
	}

	public function register()
	{
		set_error_handler( array($this,'phpError') );
		return $this;
	}

	public function phpError($errno,$errstr,$errfile,$errline)
	{
		switch ($errno) {
		case E_USER_ERROR:
		case E_ERROR:
			$no = self::ERROR;
			break;
		case E_USER_WARNING:
		case E_WARNING:
			$no = self::WARN;
			break;
		case E_USER_NOTICE:
		case E_NOTICE:
			$no = self::NOTICE;
			break;
		default:
			$no = $errno;
			break;
		}
		$str = sprintf('%s %s %s',$errstr, $errfile, $errline);
		$this->log($no, $str);
	}
}
?>
