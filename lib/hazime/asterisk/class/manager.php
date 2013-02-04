<?php
namespace Hazime\Asterisk;
use Hazime\Logger\Logging;

class Manager
{
	use Logging;
	private $_socket;

	public function connect( $host, $port, $user, $secret )
	{
		$errno = 0;
		$errstr = '';
		$this->_socket = fsockopen( $host,$port,$errno,$errstr,20);

		if( !$this->_socket )
		{
			throw new ManagerException('Can not connect asterisk server');
			return false;
		}
		// Get Header Infomation;
		$this->info('connected');
		// Get Server Response
		$this->readLine();
		// Login
		$this->command('Login',array('Username'=>$user,'Secret'=>$secret,'Events'=>'Off'));
		return true;
	}

	public function readLine( )
	{
		$line = fgets($this->_socket);
		$this->debug( 'Res:'.$line );
		return $line;
	}

	public function writeLine( $text = null )
	{
		if(func_num_args() > 1 )
		{
			return $this->writeLine(vsprintf($text,array_slice(func_get_args(),1)));
		}
		$this->debug( 'Sent: %s', trim($text)."\r\n");
		fputs( $this->_socket, trim($text)."\r\n");
	}

	public function command( $name, $params = array() )
	{
		$this->writeLine('Action: %s',$name);
		foreach( $params as $k=>$v)
		{
			$this->writeLine('%s: %s', $k,$v);
		}
		$this->writeLine();

		return $this->getResponse();
	}

	public function getResponse( )
	{
		$res = array();
		do{
			$line = $this->readLine();
			$list = explode(':',$line,2);
			$res[trim($list[0])] = trim(@$list[1]);
		}while( '' !== trim($line) );
		return $res;
	}

	public function __distruct( )
	{
		fclose($this->_socket);
	}
}
?>
