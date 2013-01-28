<?php
trait Files
{
	protected $_dirs = array();

	public function setDir( $dir )
	{
		$this->_dirs[$dir] = $dir;
	}

	public function getFile( $name )
	{
		// Create Name バリエーション
		$names = array(
			$name,
			ucfirst($name),
			$name.".php",
			ucfirst($name).".php"
		);

		foreach( $this->_dirs as $dir )
		{
			foreach( $names as $name )
			{
				$file = $dir .'/'. $name;
				if( file_exists($file) ){
					var_Dump($file);
				}
			}
		}
	}
}
?>
