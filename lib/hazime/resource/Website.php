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
	private $_website;
	private $_vars;

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
				$res[1] = $this->_website->htmlDir."/parts/".$res[1];
				echo file_get_contents($res[1]);
			}
		}
	}

	public function build( $file )
	{
		global $website;
		$website = $this;
		$file = $this->_website->htmlDir .'/layout/'.$file;
		eval( '?>'.file_get_contents($file) );
	}

	public function design( $file, $out )
	{
		ob_start();
		$this->build($file);
		$c = ob_get_contents();
		ob_end_clean();

		file_put_contents( $this->_website->designDir.'/'.$out, $c);
	}

	public function getVal( $name )
	{
		return isset($this->_vars[$name]) ?
			$this->_vars[$name]:
			":$name:undefined";
	}

	public function setVar( $name, $value )
	{
		$this->_vars[$name] = $value;
		return $this;
	}
}
?>
