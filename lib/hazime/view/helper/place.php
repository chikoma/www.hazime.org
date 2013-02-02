<?php
namespace Hazime\View\Helper;

class Place 
{
	private $_places;
	private $_contents = '';

	public function call( $caller, $name = null)
	{
		if( $name == null )
		{
			return $this;
		}else{
			return $this->$name;
		}
	}

	public function __get( $name )
	{
		if( isset($this->_places[$name]) )
		{
			return $this->_places[$name];
		}
		else
		{
			return $this->_places[$name] = new Place( );
		}
	}

	public function __set( $name, $value )
	{
		$place = $this->__get($name);
		$place->setContents( $value );
	}

	public function setContents( $contents )
	{
		$this->_contents = $contents;
	}

	public function __toString( )
	{
		return $this->_contents;
	}

	public function start( )
	{
		ob_start();
	}

	public function end( )
	{
		$this->_contents = ob_get_contents( );
		ob_end_clean();
	}
}
?>
