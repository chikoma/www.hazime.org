<?php
class Hazime_View_Helper_Place
{
	private $_places = array( );
	private $_contents = '';

	public function __construct( )
	{
	}


	public function helper( $name )
	{
		if(empty($name))
		{
			return $this;
		}
		return $this->getPlace( $name );
	}

	public function getPlace( $name ) 
	{
		if( isset($this->_places[$name]) )
		{
			return $this->_places[$name];
		}else{
			return $this->_places[$name] = new Hazime_View_Helper_Place( );
		}
	}

	public function set( $contents ){
		$this->_contents = $contents;
		return $this;
	}
	public function load( $file )
	{
		$this->set(file_get_contents($file));
	}

	public function __toString( )
	{
		$output = "";
		$output.= $this->_contents;
		return $output;
	}

	public function start( )
	{
		ob_start();
	}

	public function end( )
	{
		$this->set(ob_get_contents());
		ob_end_clean();
	}
}


?>
