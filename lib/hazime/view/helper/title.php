<?php
namespace Hazime\View\Helper;

class title
{
	private $_titles;
	private $_sep = ' - ';

	public function call( $title = null)
	{
		if( $title != null )
		{
			$this->set($title);
		}
		return $this;
	}

	public function set($title)
	{
		$this->_titles = array($title);
	}

	public function __toString( )
	{
		return sprintf("<title>%s</title>\n",implode( $this->_sep, $this->_titles ));
	}
}
?>
