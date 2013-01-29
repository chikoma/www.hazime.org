<?php
trait Logging
{
	protected $_logger = null;
	public function setLogger(Hazime_Log $logger)
	{
		$this->_logger = $logger;
		return $this;
	}

	protected function log($level, $msg)
	{
		if($this->_logger !== null){
			$this->_logger->{$level}($msg . "(CLASS=".__CLASS__.")");
		}
	}
}
?>
