<?php
require_once 'trait/Helper.php';

class Hazime_View
{
	use Helper;

	public function __construct( )
	{
		$this->addHelperDir(HAZIME_LIB.'/helper/view', 'Hazime_View_Helper');
	}

	public function execute( $file )
	{
		$view = $this;
		eval('?>'.file_get_contents($file));
	}
}
?>
