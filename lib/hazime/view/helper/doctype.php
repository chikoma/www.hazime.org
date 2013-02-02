<?php
namespace Hazime\View\Helper;

class Doctype
{
	public function call( )
	{
		return $this;
	}

	public function __toString( )
	{
		return '<!DOCTYPE html>'."\n";;
	}
}
?>
