<?php
namespace Hazime\Framework\Helper;
use Hazime\Framework as FW;

class Request extends FW\Request
{
	public function call( $caller )
	{
		$request =  new FW\Request();
		$request->setVars( $this->getVars());
		return $request;
	}
}
?>
