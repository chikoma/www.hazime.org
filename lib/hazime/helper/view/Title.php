<?php
class Hazime_View_Helper_Title 
{
	private $_sep = "-";
	private $_titles = array();

	public function __construct( $view )
	{
	}

	public function helper( $title = '' ){
		if(!empty($title))
		{
			$this->append($title);
		}
		return $this;
	}

	public function prepend( $title )
	{
		array_unshift( $this->_titles, $title );
		return $this;
	}

	public function append( $title )
	{
		array_push( $this->_titles, $title );
		return $this;
	}

	public function set( $title )
	{
		$this->_titles = array($title);
		return $this;
	}

	public function sep( $sep )
	{
		$this->_sep = $sep;
		return $this;
	}

	public function __toString( )
	{
		return "<title>".implode( $this->_sep, $this->_titles )."</title>\n";
	}
}
?>
