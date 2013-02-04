<?php
namespace Hazime\Parser\Node;

class Text extends Node
{
	public function canContain( $node )
	{
		if( $node instanceof Text )
		{
			return true;
		}
		return false;
	}
}
?>
