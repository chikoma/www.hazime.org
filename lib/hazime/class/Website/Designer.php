<?php
class Hazime_Website_Designer_Exception extends Exception{ }

class Hazime_Website_Designer
{
	private $_dir;
	use Logging;

	public function __construct( $dir )
	{
		$this->_dir = $dir;
	}

	public function createLayout( $file, $output_dir, $name )
	{
		if( !file_exists( $input_file = $this->_dir .'/'.$file) ) {
			throw new Hazime_Website_Designer_Exception( "$file is not exists" );
		}
		if( !is_dir( $output_dir ) ) {
			throw new Hazime_Website_Designer_Exception( "$output_dir is not exists" );
		}
		if( !is_dir($output_dir.'/'.$name) && !mkdir( $output_dir.'/'.$name ) ){
			throw new Hazime_Website_Designer_Exception( "Can't Create $output_dir/$name" );
		}

		$fp = fopen( $input_file, 'r');
		$layout = '';

		$places = array();
		$place_current = null;
		while( $line = fgets($fp, 1024)) 
		{
			// --------------------------------------------------------
			// Process "<!-- PLACE:SOMENAME -->"
			// --------------------------------------------------------
			if( $this->_checkPlace($line, $place_stat, $place_name ) ){
				if( $place_stat == "open" ){
					$place_current = $place_name;
					continue;
				}elseif( $place_stat == "close" ){
					if( $place_current == $place_name ){
						$layout .= sprintf("<?php place('%s') ?>\n", $place_name);
						$place_current = null;
						continue;
					}
				}
			}
			if( $place_current == null )
			{
				$layout .= $line;
			}else{
				@$places[$place_current] .= $line;
			}
		}
		foreach($places as $k=>$v){
			file_put_contents($f=$output_dir."/".$name."/default_$k.html", $v);
			$this->log('info',"write $f");
		}
		file_put_contents($f=$output_dir."/".$name."/layout.html", $layout);
		$this->log('info',"write $f");
	}

	public function getPlaces( $file )
	{
		if( !file_exists( $input_file = $this->_dir .'/'.$file) ) {
			throw new Hazime_Website_Designer_Exception( "$file is not exists" );
		}

		$fp = fopen( $input_file, 'r');
		$layout = '';

		$places = array();
		$place_current = null;
		while( $line = fgets($fp, 1024)) 
		{
			// --------------------------------------------------------
			// Process "<!-- PLACE:SOMENAME -->"
			// --------------------------------------------------------
			if( $this->_checkPlace($line, $place_stat, $place_name ) ){
				if( $place_stat == "open" ){
					$place_current = $place_name;
					continue;
				}elseif( $place_stat == "close" ){
					if( $place_current == $place_name ){
						$place_current = null;
						continue;
					}
				}
			}
			if( $place_current == null )
			{
				$layout .= $line;
			}else{
				@$places[$place_current] .= $line;
			}
		}
		return $places;
	}


	private function _checkPlace( $line, &$stat, &$name)
	{
		static $places = array( );

		$format = '/<!--\s*\[([\/]{0,1})PLACE:\s*([^\]]+)\]\s*[\/]*-->/';
		if(preg_match($format,$line,$m)){
			$name = $m[2];
			$is_close = $m[1] == '/' ? true: false;
			if( $is_close ){
				$stat = "close";
				return $name;
			}else{
				$stat = "open";
			}
			return true;
		}else{
			return false;
		}
	}
}
?>
