<?php
namespace Hazime\Application;

class Controller
{
	use AttachHelperBroker;

	public function __construct( $app )
	{
		// Helper Brokerを引き渡す
		$this->setHelperBroker( $app->getHelperBroker() );

		// Initialize
		$this->init();
	}

	public function init( )
	{
	}

	public function dispatch( $name )
	{
		if(method_exists( $this, $method = $name. 'Action') ){
			$result = call_user_func( array($this, $method ) );
		}
	}
}
?>
