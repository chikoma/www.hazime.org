<?php
class Hazime_Website_Html
{
	public $htmlDir, $designDir;
	private $_file,$_text,$_contents,$_layout;
	private $website;

	public function __construct( $website,$file )
	{
		$this->_website = $website;
		$this->_file = $file;
		$this->_text = file_get_contents( $this->_website->designDir."/".$file);
	}

	public function parse( )
	{
		$lines = explode("\n", $this->_text);
		$block = array();
		$layout = '';
		$buf = '';
		$contents = array();
		foreach($lines as $line)
		{
			if( preg_match('/<!--\sSTART:BLOCK\s([^\s]+)\s[\/]*-->/', $line, $w) ){
				array_push($block, $w[1]);
			}elseif( preg_match('/<!--\sEND:BLOCK\s([^\s]+)\s[\/]*-->/', $line, $w) ){
				$layout.='<?php layout("'.$w[1].'");?>'."\n";
				$contents[implode($block,"/")]=$buf;
				$buf = '';
				array_pop($block);
			}elseif( empty($block) ){
				$layout.= $line."\n";
			}else{
				$buf .= $line."\n";
			}
		}
		$this->_contents = $contents;
		$this->_layout = $layout;
	}

	public function getContents( )
	{
		return $this->_contents;
	}

	public function getLayout( )
	{
		return $this->_layout;
	}
	public function getContent( $name )
	{
		return $this->_contents[$name];
	}
}
?>
