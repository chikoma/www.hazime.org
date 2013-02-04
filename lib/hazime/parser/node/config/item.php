<?php
namespace Hazime\Parser\Node\Config;
use Hazime\Parser\Node\Node;
use Hazime\Parser\Node\Text;

class Item extends Node
{
	static function factory( $params, $line )
	{
		$sep = $params['sep'];
		$list = explode( $sep, $line, 2);
		return new Item($list[0], $list[1]);
	}

	public function __construct( $key, $value )
	{
		parent::__construct( $key.'='.$value );
		$this->_key = $key;
		$this->addChild(new Text($value));
	}

	public function canContain( $node )
	{
		if( $node instanceof Text )
		{
			return true;
		}
	}

	public function getKey( )
	{
		return trim($this->_key);
	}

	public function getValue( )
	{
		return trim($this->getFirst()->toString());
	}
}
?>
