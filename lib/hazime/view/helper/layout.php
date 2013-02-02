<?php
namespace Hazime\View\Helper;
use Hazime\View\View;

class Layout extends View
{
	private $_name = null;
	private $_view;

	public function call( View $view, $name = null )
	{
		$this->_view = $view;

		if( $name !== null )
		{
			$this->_name = $name;
		}
		return $this;
	}

	public function isEnable( )
	{
		return $this->_name == null ? false: true;
	}

	public function display( )
	{
		$this->setViewDir( 
			$this->_view->getViewDir()
		);

		$this->_displayLayout( $this->_name );
	}
}
?>
