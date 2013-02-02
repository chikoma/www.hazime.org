<?php
namespace Hazime\View\Helper;

class IE
{
	public function call( )
	{
		return $this;
	}

	public function __toString( )
	{
		return <<<EOF
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->\n
EOF
;
	}
}
?>
