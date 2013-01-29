<?php
class Hazime_View_Helper_Doctype
{
	private $_doctype = '';

	public function __construct( $view )
	{
	}

	public function helper( $type )
	{
		switch($type)
		{
		case 'strict':
			$this->set(
				'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'
			);
			break;
		case 'transitional':
			$this->set(
				'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'
			);
			break;
		case 'frameset':
			$this->set(
				'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'
			);
			break;
		case 'html5':
			$this->set(
				'<!DOCTYPE html>'
			);
			break;
		default:
			$this->set($type);
		}
		return $this;
	}
	public function set( $doctype )
	{
		$this->_doctype = $doctype;
		return $this;
	}
	public function __toString( )
	{
		return $this->_doctype."\n";
	}
}
?>

