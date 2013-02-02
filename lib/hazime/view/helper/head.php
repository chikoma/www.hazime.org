<?php
namespace Hazime\View\Helper;

class Head
{
	private $_meta;

	public function __construct( )
	{
		$this->_meta = new HeadMeta( );
	}

	public function meta( )
	{
		return $this->_meta;
	}
}
?>
