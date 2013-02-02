<?php
namespace Hazime\View\Helper;

class title
{
	private $_titles;
	private $_sep = ' - ';
	private $_view;

	public function call( View $view, $title = null)
	{
		$this->_view = $view;
		if( $title != null )
		{
			$this->set($title);
		}
		return $this;
	}


	public function append( $title )
	{
		$this->_titles[] = $title;
		return $this;
	}
	public function set($title)
	{
		$this->_titles = array($title);
		return $this;
	}

	public function __toString( )
	{
		$this->_view->meta( )->property('og:title',implode( $this->_sep, $this->_titles ));
		return sprintf("<title>%s</title>\n",implode( $this->_sep, $this->_titles ));
	}
}
?>
