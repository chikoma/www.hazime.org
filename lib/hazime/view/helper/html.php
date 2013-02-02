<?php
namespace Hazime\View\Helper;

class Html
{
	public function call( )
	{
		return $this;
	}

	public function __toString( )
	{
		return '<html lang="ja" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml">'."\n";
	}
}
?>
