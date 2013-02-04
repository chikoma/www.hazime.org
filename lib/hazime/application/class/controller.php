<?php
namespace Hazime\Application;

class Controller
{
	use AttachHelperBroker;

	public function dispatch( $name )
	{
		if(method_exists( $this, $method = $name. 'Action') ){
			$result = call_user_func( array($this, $method ) );
		}
	}
}
?>
