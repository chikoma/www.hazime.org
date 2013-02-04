<?php
namespace Hazime\Asterisk;
use Hazime\Logger\Logging;
use Hazime\Socket\Socket;

class Manager 
{
	use Logging;
	private $_host,$_port,$_user,$_secret;
	private $_socket = false;

	public function __construct( $host = 'localhost', $port = '5038', $user = 'admin', $secret = 'hogehoge' )
	{
		$this->_host = $host;
		$this->_port = $port;
		$this->_user = $user;
		$this->_secret = $secret;
	}

	public function connect( )
	{
		$this->_socket = new Socket($this->_host,$this->_port);
		$this->_socket->setLogger($this->getLogger());
		$this->_socket->connect();
	}
	public function disconnect( )
	{
		$this->_socket->disconnect();
	}

	public function sendCommand( $name, $params = array() )
	{
		$this->_socket->writeLine('Action: %s',$name);
		foreach( $params as $k=>$v)
		{
			$this->_socket->writeLine('%s: %s', $k,$v);
		}
		$this->_socket->writeLine();
	}

	public function login( )
	{
		$this->sendCommand('Login',array('Username'=>$this->_user, 'Secret'=>$this->_secret,'Events'=>'off'));
	}

	public function logoff( )
	{
		$this->sendCommand('Logoff');
	}

	public function command( $name, $params = array())
	{
		$this->connect( );
		$this->login();
		$this->sendCommand($name,$params);
		$this->logoff();
		$resp = $this->_socket->getResponse();
		$this->disconnect();
	}
}
?>
