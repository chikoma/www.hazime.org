<?php
//
// Require Hazime Root Class
// =======================
require_once '../lib/hazime/class/Hazime.php';
$hazime = Hazime::getInstance( );
//
// Set UP Logger
// =======================
$hazime->setLogger(new Hazime_Log());
//
// Set Develop Mode
// =======================
$hazime->developMode();
//
// Set UP Boot Strap
// =======================
require_once '../app/Bootstrap.php';
$bs = new App_Bootstrap( );
$bs->addResourceDir(HAZIME_LIB.'/resource','Hazime_Resource');
//
// Get Website Resource
// =======================
$website = $bs->website();
//
// HTMLをビルドする
// ------------------------
$website->addLayout('header','header.html');
$website->addLayout('footer','footer.html');
$website->addLayout('aside','profile.html');
$website->addLayout('aside_adv','adv.html');
$website->addLayout('contents','contents.html');
$website->build('main.html');
?>
