<?php
namespace Hazime\View\Helper;

class Style
{
	private $_files = array();

	public function call( )
	{
		return $this;
	}

	/**
	 * <link href="css/iphone.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 0px) and (max-width: 320px)" >
	 */
	public function append( $href, $rel='stylesheet', $type='text/css', $media='' )
	{
		$this->_files[] = compact('href','rel','type','media');
		return $this;
	}
	public function prepend( $href, $rel='stylesheet', $type='text/css', $media='' )
	{
		array_unshift($this->_files,compact('href','rel','type','media'));
		return $this;
	}

	public function __toString( )
	{
		array_unique( $this->_filed );
		$string = "";
		foreach( $this->_files as $arr )
		{
			$string.= '<link ';
			foreach( $arr as $k=>$v ) if(!empty($v)) $string .= sprintf( ' %s="%s"', $k, $v);
			$string.= '>'."\n";
		}
		return $string;
	}
}
?>
