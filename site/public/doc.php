<?php
//============================
// Header
//============================
use Hazime\Hazime;
use Hazime\Config\Config;
use Hazime\Application\Application;
use Hazime\Application\Front\Front as Front;
use Hazime\Application\Front\Command as Command;
//============================
// PHP Setting
//============================
ini_set('display_errors', 'On');
//============================
// Require Hazime Library
//============================
require_once dirname(__FILE__).'/../../lib/hazime/hazime.php';
//============================
// Setup Hazime Library
//============================
Hazime::getInstance( )->register();
//============================
// Main Logic
//============================
$config = new Config();
$config->load(dirname(__FILE__).'/../config/config.ini');

// Create Application
$app = new Application($config);

// Init Front Controller
$app->bootstrap('front');
?>
