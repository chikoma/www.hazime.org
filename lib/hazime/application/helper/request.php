<?php
namespace Hazime\Application\Helper;
use Hazime\Request\Request as HazimeRequest;

class Request extends HazimeRequest
{
	public function call( $datas = array() )
	{
		foreach( $datas as $k=>$v )
		{
			$this->set($k,$v);
		}
		return $this;
	}
}
?>
