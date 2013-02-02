<?php
namespace Hazime\View\Helper;

class Keywords
{
	private $_keywords = array();
	private $_sep = ', ';
	private $_view;

	public function call( View $view,  $keyword = null)
	{
		$this->_view = $view;
		if( $title != null )
		{
			$this->append($keyword);
		}
		return $this;
	}


	public function append( $keywors )
	{
		$this->_keywords = array_merge($this->_keywords,explode(',',$keywors));
		return $this;
	}

	public function __toString( )
	{
		$this->_view->meta()->add(
			array('name'=>'keywords','content'=>implode(',',$this->_keywords)));
		$this->_view->meta()->property('og:keywords',implode(',',$this->_keywords));
		return '';
	}
}
?>
