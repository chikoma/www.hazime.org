<?php
require_once 'class/Website/Website.php';

function layout( $name )
{
	global $website;

	echo "<!-- START:BLOCK $name //-->\n";
	$website->dispLayout($name);
	echo "<!-- END:BLOCK $name //-->\n";
}
function getVal( $name )
{
	global $website;
	return $website->getVal($name);
}
class Hazime_Resource_Website
{
	use Logging;

	private $_layout_resource = array();
	private $_html_dir = ".";
	private $_design_dir = ".";
	private $_public_dir = ".";
	private $_website;

	public function __construct( )
	{
		$this->_website = new Hazime_Website();
	}

	public function importLayout($rule)
	{
		$this->_website->importLayout( $rule );
	}

	public function importContents($rule)
	{
		$this->_website->importContents( $rule );
	}

	public function setHtmlDir( $dir )
	{
		$this->_website->htmlDir = $dir;
	}
	public function setDesignDir( $dir )
	{
		$this->_website->designDir = $dir;
	}
	public function setPublicDir( $dir )
	{
		$this->_website->publicDir = $dir;
	}

	public function addLayout( $name, $resource, $type="file" )
	{
		$this->_layout_resource[$name] = array($type,$resource);
	}
	public function dispLayout( $name )
	{
		if( !isset( $this->_layout_resource[$name] ) )
		{
			echo "$name resource not set";
		}else{
			$res = $this->_layout_resource[$name];
			if( $res[0] == 'file' )
			{
				$res[1] = $this->_html_dir."/parts/".$res[1];
				echo "<!-- START:INFILE parts/".basename($res[1])." //-->\n";
				echo file_get_contents($res[1]);
				echo "<!-- END:INFILE parts/".basename($res[1])." //-->\n";
			}
		}
	}

	public function build( $file )
	{
		global $website;
		$website = $this;
		$file = $this->_html_dir .'/layout/'.$file;
		eval( '?>'.file_get_contents($file) );
	}

	public function design( $layout, $file )
	{
		ob_start();
		$this->build($layout);
		$contents = ob_get_contents();
		ob_end_clean();
		file_put_contents( $this->_design_dir."/".$file, $contents );
	}

	public function parseParts( $file )
	{
		$file = $this->_design_dir."/".$file;
		$fp = fopen($file, 'r');
		$block = $texts = array();
		while( $line = fgets($fp, 1024 ))
		{
			if( preg_match('/<!--\sSTART:INFILE\s([^\s]+)\s[\/]*-->/', $line, $w) ){
				array_push($block, $w[1]);
				$texts[$block[0]] = "";
			}elseif( preg_match('/<!--\sEND:INFILE\s([^\s]+)\s[\/]*-->/', $line, $w) ){
				array_pop($block);
			}elseif( !empty($block) ){
				$texts[$block[0]] .= $line;
			}
		}
		fclose($fp);
		foreach( $texts as $file=>$text )
		{
			if(trim($text) !== "")
			{
				$this->log(Hazime_Log::INFO, 'write parts/html  '.$file);
				file_put_contents($this->_html_dir."/".$file, $text );
			}
		}
	}

	public function parseLayout( $file, $name = 'layout.html' )
	{
		$file = $this->_design_dir."/".$file;
		$fp = fopen($file, 'r');
		$layout = "";
		$block = array();
		while( $line = fgets($fp, 1024 ))
		{
			if( preg_match('/<!--\sSTART:BLOCK\s([^\s]+)\s[\/]*-->/', $line, $w) ){
				array_push($block, $w[1]);
			}elseif( preg_match('/<!--\sEND:BLOCK\s([^\s]+)\s[\/]*-->/', $line, $w) ){
				$layout.='<?php layout("'.$w[1].'");?>'."\n";
				array_pop($block);
			}elseif( empty($block) ){
				$layout.= $line;
			}
		}
		fclose($fp);

		$layout = preg_replace('/\{\{(.+)\}\}/','<?php echo getVal("\1"); ?>', $layout);
		file_put_contents( $out = $this->_html_dir."/layout/".$name, $layout );
		$this->log(Hazime_Log::INFO, 'write layout into '.$out);
	}

	public function copyAssets( )
	{
		$this->copyDirectory($this->_design_dir ."/assets", $this->_public_dir."/assets");
	}

	private function copyDirectory( $s, $d)
	{
		if( is_dir( $s ) ){
			@mkdir( $d );
			$dir = dir($s);
			while( $read = $dir->read() ){
				if( $read == "." || $read == ".." ){
					continue;
				}
				$path = $s.'/'.$read;
				if( is_dir($path) ){
					$this->copyDirectory( $path, $d."/".$read );
					continue;
				}
				copy($path, $d."/".$read);
			}
		}else{
			copy($s,$d);
		}
	}

	public function getVal( $name )
	{
		//return "<!-- START:GETVAL $name -->ダミー$name<!-- END:GETVAL $name//-->";
		return "ダミー";
	}

}
?>
