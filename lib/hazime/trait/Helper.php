<?php
trait Helper
{
	use Logging;

	private $_broker = array();

	public function __get( $name )
	{
		return $this->getHelper($name);
	}

	public function __call( $name, $args )
	{
		return call_user_func_array(array($this->getHelper($name),'helper'), $args);
	}

	public function getHelper( $name )
	{
		if(isset($this->_broker[$name]))
		{
			return $this->_createIfNotObject( $this->_broker[$name] );
		}
		throw new RuntimeException( "helper $name not found" );
	}

	public function addHelperDir( $dir, $prefix )
	{
		$this->log(Hazime_Log::INFO, "add helper dir $dir as $prefix");
		foreach( glob( "$dir/*.php") as $file )
		{
			// File Info 
			$info = array();
			$info['realname'] = $file;
			$info['filename'] = basename($file);
			$info['prefix'] = $prefix;
			$info['name'] = substr( $info['filename'], 0, strpos($info['filename'],".") );
			$info['classname'] = $prefix ."_".ucfirst( $info['name'] );

			// Add Resource As Lazy
			$this->addHelper($info['name'],'lazy',$info);
		}
	}

	public function addHelper( $name, $type, $option = array( ) )
	{
		$this->log(Hazime_Log::DEBUG, "add helper $name");
		$this->_broker[strtolower($name)] =  array($type, $option );
	}

	private function _createIfNotObject( &$info )
	{
		if(is_object($info)){
			return $info;
		}elseif($info[0] == 'lazy'){
			require_once $info[1]['realname'];
			$rc = new ReflectionClass( $info[1]['classname'] );
			return $info = $rc->newInstance( $this );
		}
	}

}
?>
