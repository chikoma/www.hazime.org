<?php
namespace Hazime\Config;
use Hazime\Parser as Parser;
use Hazime\Parser\Node\Config\Item as ItemNode;
use Hazime\Parser\Node\Config\Directive as DirectiveNode;

/**
 * Exception
 */
class ConfigLoadFileException extends \Exception{ };

class Config
{
	private $_items;
	private $_sections = array();

	public function loadFile( $file, $name = null )
	{
		if( !$file || !is_readable($file))
		{
			throw new ConfigLoadFileException("can't read $file");
		}

		$parser = new Parser\Config();
		$cur = $parser->parseFile( $file );
		$config = $name ? $this->section($name): $this;
		$visitor = new ParserVisitor( $config );
		$cur->accept( $visitor );
	}

	public function section( $name )
	{
		return isset($this->_sections[$name]) ?
			$this->_sections[$name]:
			$this->_sections[$name] = new Section($name);
	}
	public function __set( $name, $value )
	{
		$this->set($name, $value);
	}

	public function set($name, $value)
	{
		$this->_items[$name] = $value;
	}

	public function __get( $name )
	{
		if(isset($this->_sections[$name])){
			return $this->_sections[$name];
		}
		return $this->get($name);
	}

	public function get($name)
	{
		return $this->_items[$name];
	}
}

class Section extends Config
{
	private $_name;
	public function __construct($name)
	{
		$this->_name = $name;
	}
}


class ParserVisitor
{
	private $_config;

	public function __construct( $config )
	{
		$this->_config = $config;
		$this->_current = $this->_config;
	}

	public function visit( $node )
	{
		if( $node instanceof DirectiveNode )
		{
			$this->_current = $this->_config->section($node->getText());
		}
		if( $node instanceof ItemNode )
		{
			$this->_current->{$node->getKey()} = $node->getValue();
		}
	}
}
?>
