<?php
namespace Application\Asterisk\Controller;
use Hazime\Application\Controller;

class AMI extends Controller
{
	private $ams;

	public function init( )
	{
		$this->ams = $this->bootstrap()->AMI;
	}

	public function executeAction( )
	{
		$this->ams->command( 'Reload' );
	}

	public function commandAction( )
	{
		$this->ams->command( $this->request()->command );
	}

	public function reloadAction( )
	{
		$this->ams->command( 'Reload' );
	}

	public function callAction( )
	{
		$req = $this->request( );
		$this->ams->command('Originate',array(
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
