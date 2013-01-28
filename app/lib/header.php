<?php
// app/lib/header.php
// =========================
// 基本的なヘッダー
// =========================
//
//
// =========================
$dir = realpath(dirname(__FILE__)."/../../"); // uper app dir 

//
// Require Hazime Root Class
// =========================
require_once $dir.'/lib/hazime/class/Hazime.php';
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
require_once dirname(__FILE__).'/../Bootstrap.php';
$bs = new App_Bootstrap( );
$bs->addResourceDir(HAZIME_LIB.'/resource','Hazime_Resource');
?>
