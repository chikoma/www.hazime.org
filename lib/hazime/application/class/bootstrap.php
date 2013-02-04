<?php
namespace Hazime\Application;
use Hazime\Bootstrap\Bootstrap as Hazime_Bootstrap;
use Hazime\Application\Helper;

class Bootstrap extends Hazime_Bootstrap
{

	public function initHelperBroker( )
	{
		$broker = new Helper\Broker( );
		$broker->set('request', 'Hazime\\Application\\Helper\\Request');
		$broker->set('bootstrap', 'Hazime\\Application\\Helper\\Bootstrap');
		$broker->set('view', 'Hazime\\Application\\Helper\\View');
		$broker->call('bootstrap',array($this ));
		return $broker;
	}

}
?>
