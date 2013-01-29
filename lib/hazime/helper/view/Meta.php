<?php
/**
 */
class Hazime_View_Helper_Meta
{
	private $_metas = array();
	private $_view;

	public function __construct( $view )
	{
		$this->_view = $view;
	}

	public function helper( )
	{
		return $this;
	}

	public function __call( $name, $args )
	{
		$this->_metas[$name] = $args[0];

		if(in_array($name, array('keyword','title','description')) ){
			$this->_view->og->$name($args[0]);
		}
		return $this;
	}

	public function __toString( )
	{
		$output = "";
		foreach( $this->_metas as $k=>$v )
		{
			if( $k == "charset" ){
				$output.= sprintf('<meta %s="%s">'."\n",$k,$v);
			}else{
				$output.= sprintf('<meta name="%s" content="%s">'."\n",$k,$v);
			}
		}
		return $output;
	}
}
?>
