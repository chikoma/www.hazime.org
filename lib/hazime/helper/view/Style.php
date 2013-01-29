<?php
class Hazime_View_Helper_Style
{
	private $_files;

	public function __construct( $view )
	{
	}
	public function helper( $file = null )
	{
		if($file != null)
		{
			$this->addFile( $file );
		}
		return $this;
	}

	public function addFile( $file )
	{
		$this->_files[$file] = $file;
		return $this;
	}

	public function __toString( )
	{
		$output = '';
		foreach( $this->_files as $file )
		{
			$output .= sprintf('<link rel="StyleSheet" href="%s">',$file);
		}
		return $output;
	}
}
?>
