<?php
use Hazime\Hazime;
use Hazime\Core\Registry;

ini_set('display_errors','on');
require_once dirname(__FILE__) . '/../../lib/hazime/hazime.php';

// Start
Hazime::getInstance( )->register( );

// Set Site Root
Registry::set('site_root', realpath(dirname(__FILE__).'/..'));

// Load Bootstrap
require_once dirname(__FILE__) . '/bootstrap.php';
?>
