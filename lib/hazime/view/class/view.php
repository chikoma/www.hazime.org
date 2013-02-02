<?php
namespace Hazime\View;
use Hazime\Helper\Helpable;

function place($name)
{
	$view = View::$view;
	echo $view->place()->$name."\n";
}

class View
{
	use Helpable;
	static public $view;

	private $_view_dir;

	public function __construct( )
	{
		$this->getHelperBroker( )->addDir( dirname(__FILE__).'/../helper', 'Hazime\\View\\Helper');
	}

	public function setViewDir( $dir )
	{
		$this->_view_dir = $dir;
	}

	public function getViewDir( )
	{
		return $this->_view_dir;
	}

	public function display( $script )
	{
		if( $this->layout()->isEnable() )
		{
			ob_start();
		}

		$this->_displayScript( $script );

		if( $this->layout()->isEnable() )
		{
			$contents = ob_get_contents();
			$this->layout( )->place( )->contents = $contents;
			ob_end_clean();
			$this->layout( )->display( );
		}
	}

	private function _displayScript( $script )
	{
		$view_script = $this->_view_dir .'/script/'. $script;
		$this->renderer( $view_script );
	}
	protected function _displayLayout( $script )
	{
		$view_script = $this->_view_dir .'/layout/'. $script;
		$this->renderer( $view_script );
	}

	public function renderer( $file )
	{
		self::$view  = $this;
		$view  = $this;
		eval('?><?php namespace Hazime\\View;?>'.trim(file_get_contents($file)));
	}
}
?>
