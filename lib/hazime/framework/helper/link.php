<?php
namespace Hazime\Framework\Helper;

class Link
{
	public function call( $caller,$name, $act, $ctl, $mod )
	{
		$url = '?a='.$act;
		return sprintf('<a href="%s">%s</a>',$url,$name);
	}
}
?>
