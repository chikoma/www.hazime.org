<?php
namespace Hazime\View\Helper;

class description
{
	private $_description;
	private $_view;

	public function call( View $view, $description = '')
	{
		$this->_view = $view;
		$this->_description = $description;
		if( $title != null )
		{
			$this->set($title);
		}
		return $this;
	}

	public function __toString( )
	{
		$this->_view->meta( )->property('og:description',$this->_description);
		$this->_view->meta( )->add(
			array('name'=>'description','content'=>$this->_description)
		);
		return "";
	}
}
?>
