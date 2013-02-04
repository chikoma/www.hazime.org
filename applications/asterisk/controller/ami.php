<?php
namespace Application\Asterisk\Controller;
use Hazime\Application\Controller;

class AMI extends Controller
{
	public function executeAction( )
	{
		$ams = $this->bootstrap()->AMI;
		$ams->command( 'Reload' );
	}

	public function reloadAction( )
	{
		$ams = $this->bootstrap()->AMI;
		$ams->command( 'Reload' );
	}

	public function callAction( )
	{
		$req = $this->request( );
		$ams = $this->bootstrap()->AMI;

		$ams->command('Originate',array(
			'Channel'=>$req->channel('SIP/201'),
			'Callerid'=>$req->callerid('Hazime <201>'),
			'Context'=>$req->context('201-out'),
			'Priority'=>$req->priority(1),
			'Async'=>$req->async(1),
			'Exten'=>$req->exten(201)
		));
	}
}

?>
