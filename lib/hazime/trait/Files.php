<?php
trait Files
{
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
}
?>
