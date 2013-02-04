<?php
namespace Hazime\Parser\Node;

abstract class Node {
	private $_text;
	private $_parent;
	private $_children = array();

	public function accept( $visitor )
	{
		$visitor->visit( $this );
		foreach($this->_children as $c )
		{
			$c->accept($visitor);
		}
	}

	public function __construct( $text = null)
	{
		$this->_text = $text;
	}

	public function getText( )
	{
		return $this->_text;
	}
	public function getLast( )
	{
		$num = count($this->_children);
		return $num > 0 ? $this->_children[$num-1]: $this;
	}

	public function getFirst( )
	{
		return $this->_children[0];
	}

	public function getParent( )
	{
		if($this->_parent)
		{
			return $this->_parent;
		}
		return $this;
	}

	public function setParent( $node )
	{
		$this->_parent = $node;
		return $this;
	}

	public function canContain( $node )
	{
		return false;
	}

	public function addChild( $node )
	{
		if($this->canContain($node))
		{
			return $this->_addChild( $node );
		}

		if( $this->getParent( ) == $this )
		{
			throw new Exception('Cant add node here');
		}
		return $this->getParent( )->addChild($node);
	}

	protected function _addChild( $node )
	{
		$node->getParent( )->setParent($this);
		$this->_children[] = $node;
		return $node->getLast();
	}

	public function toString( )
	{
		$text = $this->getText();
		foreach($this->_children as $c )
		{
			$text.= $c->toString();
		}
		$text.= "";
		return $text;
	}
}
?>
