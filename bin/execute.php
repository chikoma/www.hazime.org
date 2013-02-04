#!/usr/bin/php
<?php
use Hazime\Hazime;
use Hazime\Application\Front\Front as Front;
use Hazime\Application\Front\Command as Command;
require_once dirname(__FILE__).'/../lib/hazime/hazime.php';
Hazime::getInstance( )->register();
$front = Front::factory('command',dirname(__FILE__).'/../config/front.conf');
$front->run( );
?>
