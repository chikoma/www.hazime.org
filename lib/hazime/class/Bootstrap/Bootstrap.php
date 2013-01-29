<?php
class Hazime_Bootstrap
{
	use Logging;
	private $_resource = array();

	public function __construct( ) { }

	public function addResourceDir( $dir, $prefix )
	{
		$this->log(Hazime_Log::INFO, "add resource dir $dir as $prefix");
		foreach( glob( "$dir/*.php") as $file )
		{
			// File Info 
			$info = array();
			$info['realname'] = $file;
			$info['filename'] = basename($file);
			$info['prefix'] = $prefix;
			$info['name'] = substr( $info['filename'], 0, strpos($info['filename'],".") );
			$info['classname'] = $prefix;

			// Add Resource As Lazy
			$this->addResource($info['name'],'lazy',$info);
			$this->log(Hazime_Log::DEBUG,print_r($info,true));
		}
	}

	public function addResource( $name, $type, $options )
	{
		$this->_resource[strtolower($name)] = array($type,$options);
		$this->log(Hazime_Log::DEBUG,"Add Resource $name Type=$type");
	}

	public function getResource( $name, $args = array() )
	{
		if( isset($this->_resource[strtolower($name)]) ){
			$info = $this->_resource[strtolower($name)];
			if( $info[0] == 'lazy' ){
				require_once $info[1]['realname'];
				$rc = new ReflectionClass( $info[1]['prefix'] ."_". $info[1]['name'] );
				$this->log('info', "Load Resouce \"$name\"");
				return $this->_resource[strtolower($name)] = $rc->newInstanceArgs( $args );
			}
		}
		$this->log('warn', "Bootstrap Resouce \"$name\" not found");
		return null;
	}

	public function __call( $name, $args )
	{
		if( 0 === substr_compare($name, 'get', 0, 3))
		{
			$name = substr( $name, 3 );
			return $this->getResource( $name, $args );
		}
		else
		{
			if(isset($this->_running[strtolower($name)]))
			{
				return $this->_running[strtolower($name)];
			}
			if(method_exists( $this,$method="init".$name ) ){
				return $this->_running[strtolower($name)] = call_user_func(array($this,$method));
			}else{
				return $this->_running[strtolower($name)] = $this->getResource($name);
			}
		}
		throw new RuntimeException("Undefined Method $name");
	}

	public function __get( $name )
	{
		if(isset($this->_running[strtolower($name)]))
		{
			return $this->_running[strtolower($name)];
		}elseif(method_exists( $this,$method="init".$name ) ){
			return $this->_running[strtolower($name)] = call_user_func(array($this,$method));
		}else{
			return $this->_running[strtolower($name)] = $this->getResource($name);
		}
		throw new RuntimeException("Undefined Resource $name");
	}
}
?>
