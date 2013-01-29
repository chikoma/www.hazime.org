<?php
require_once 'trait/Files.php';
require_once 'trait/Logging.php';

class Hazime_Website
{
	use Logging;
	static $website = 'aaa';

	private $_current_layout = null;
	private $_current_places = null;
	private $_template_dir = 'html';
	private $_design_dir = 'design';
	private $_public_dir = 'public';

	public function init( $config )
	{
		$config_rule = array(
			'template_dir'=>'_template_dir',
			'design_dir'=>'_design_dir',
			'public_dir'=>'_public_dir'
		);
		foreach( $config_rule as $k=>$v )
		{
			if(isset($config[$k])) $this->$v = $config[$k];
		}
	}

	public function designer( )
	{
		require_once 'class/Website/Designer.php';
		return new Hazime_Website_Designer( $this->_design_dir );
	}

	public function designDir( )
	{
		return $this->_design_dir;
	}

	public function layoutDir( )
	{
		return $this->_template_dir . '/layout/';
	}
	public function publicDir( )
	{
		return $this->_public_dir;
	}
	public function htmlDir( )
	{
		return $this->_template_dir;
	}

	public function show( $config )
	{
		$this::$website = $this;
		include_once 'class/Website/Scripts/default.php';
		$this->_current_layout = $layout = $config['layout'];
		$this->_current_places = $config['places'];
		$layout = sprintf('%s/%s/layout.html',$this->layoutDir( ),$this->_current_layout);
		eval('?>'.file_get_contents($layout));
	}

	public function place( $name ){
		printf( '<!-- [PLACE:%s] -->'."\n" , $name );

		if( !isset($this->_current_places[$name]) )
		{
			$file = sprintf('%s/%s/default_%s.html',$this->layoutDir( ),$this->_current_layout, $name);
			echo file_get_contents($file);
		}else{
			echo $this->process( $this->_current_places[$name] );
		}
		printf( '<!-- [/PLACE:%s] -->'."\n" , $name );
	}

	public function process( $name )
	{
		if( preg_match('/(.*):\/\/(.*)/',$name, $m) ) {
			$type = $m[1];
			$script = $m[2];
			switch($type){
			case 'file':
				$file = $this->_template_dir.'/files/'.$script;
				echo file_get_contents($file);
				break;
			default:
				var_dump($name);
				break;
			}

		}else{
			echo $name;
		}
	}
}
?>
