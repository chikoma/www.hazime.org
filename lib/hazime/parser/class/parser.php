<?php
namespace Hazime\Parser;

class Parser
{
	private $_algorithm = array();
	private $_sep = "\n";
	private $_comment = ";";

	public function addAlgorithm($regex, $name, $params )
	{
		$this->_algorithm[$regex] = array($regex,$name, $params);
	}

	public function parseFile( $file )
	{
		$text = file_get_contents($file);
		return $this->parseText( $text );
	}

	public function parseText( $text )
	{
		$lines = explode( $this->_sep, $text );
		$eol = $this->_sep;
		$root = $this->createRootNode( );
		$cur = $root;


		foreach($lines as $line )
		{
			if($this->isCommentLine($line)) continue;
			$line = trim($line).$eol;

			// ==========================================
			// アルゴリズムに一致したらオブジェクトにする
			// 一致しなければテキストオブジェクトにする
			// ==========================================
			$node = false;
			foreach( $this->_algorithm as $alg )
			{
				if(preg_match('/'.$alg[0].'/', $line))
				{
					$node = $this->createNode( $alg[1],$alg[2],$line );
				}
			}
			if(!$node){
				$node = $this->createTextNode( $line );
			}
			$cur = $cur->addChild($node);
		}
		return $root;
	}

	protected function isCommentLine( $line )
	{
		if( strlen($line) > 0 && substr_compare($line,$this->_comment,0,1) === 0)
		{
			return true;
		}
		return false;
	}
	protected function createTextNode( $line )
	{
		return new Node\Text($line);
	}

	protected function createNode( $name, $params, $line )
	{
		die("ERROR".$name);

	}
	protected function createRootNode( )
	{
		return new Node\Root( );

	}
}
?>
