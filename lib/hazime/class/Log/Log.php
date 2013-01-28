<?php
class Hazime_Log
{
	const NOTICE='notice';
	const WARN='warn';
	const ERROR='error';
	const INFO='info';
	const DEBUG='debug';

	public function notice( $msg )
	{
		$this->log("notice", $msg);
	}

	public function warn( $msg )
	{
		$this->log("warn", $msg);
	}

	public function error( $msg )
	{
		$this->log("error", $msg);
	}

	public function info( $msg )
	{
		$this->log("info", $msg);
	}

	public function debug( $msg )
	{
		$this->log("debug", $msg);
	}

	public function log( $level,$msg )
	{
		$time = date('Y-m-d H:i:s');
		printf('[%s] [%s] %s<br />'."\n",$time,$level,$msg);
	}
}
?>
