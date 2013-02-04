<?php
namespace Hazime\Logger;

trait Logging
{
	private $_logger;

	public function setLogger( Logger $logger )
	{
		if($logger){
			$this->_logger = $logger;
		}
		return $this;
	}
	public function getLogger( )
	{
		return $this->_logger;
	}

	private function _makeMsg( $msgs )
	{
		if( count($msgs) == 1 ){
			$msg = $msgs[0];
		}else{
			$msg = vsprintf($msgs[0],array_slice($msgs,1));
		}
		return $msg;
	}

	public function log( $level, $msg )
	{
		if(!$this->_logger) return false;
		$msg = $this->_makeMsg(array_slice(func_get_args(),1));
		$this->_logger->log(Logger::LOG, $msg);
	}

	public function debug( $msg )
	{
		if(!$this->_logger) return false;
		$msg = $this->_makeMsg(func_get_args());
		$this->_logger->log(Logger::DEBUG, $msg);
	}

	public function info( $msg )
	{
		if(!$this->_logger) return false;
		$msg = $this->_makeMsg(func_get_args());
		$this->_logger->log(Logger::INFO, $msg);
	}

	public function warn( $msg )
	{
		if(!$this->_logger) return false;
		$msg = $this->_makeMsg(func_get_args());
		$this->_logger->log(Logger::WARN, $msg);
	}

	public function error( $msg )
	{
		if(!$this->_logger) return false;
		$msg = $this->_makeMsg(func_get_args());
		$this->_logger->log(Logger::ERROR, $msg);
	}

	public function verbose( )
	{
		if($this->_logger){
			$this->setLogger(new Logger());
		}
	}
}
?>
