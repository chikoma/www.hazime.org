<?php
namespace Hazime\Parser;

class Config extends Parser
{
	public function __construct( )
	{
		$this->init( );
	}

	protected function init( )
	{
		$this->addAlgorithm('^\[','Directive',array('start'=>'[','end'=>']'));
		$this->addAlgorithm('^[a-zA-Z1-9_-]+\s*=','Item',array('sep'=>'='));
	}

	protected function createNode( $name, $params, $line )
	{
		$ns = 'Hazime\Parser\Node\Config';
		$class = $ns.'\\'.$name;
		return $class::factory( $params, $line);
	}
}
?>
