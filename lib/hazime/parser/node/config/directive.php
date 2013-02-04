<?php
namespace Hazime\Parser\Node\Config;
use Hazime\Parser\Node\Node;

class Directive extends Node
{
	static function factory( $params, $line )
	{
		$start = preg_quote($params['start']);
		$end = preg_quote($params['end']);

		if(preg_match("/$start(.*)$end/", $line, $m ))
		{
			$text = $m[1];
		}
		return new Directive($m[1]);
	}

	public function canContain( $node )
	{
		if( $node instanceof Item )
		{
			return true;
		}
	}
}
?>
