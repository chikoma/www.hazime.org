<?php
namespace Hazime\Framework\Helper;
use Hazime\Framework as FW;

class Response extends FW\Response
{
	public function call( $caller )
	{
		return new FW\Response();
	}
}
?>
