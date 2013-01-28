<?php
// Hazime Root Path
// =======================
$path = realpath(dirname(__FILE__).'/../lib/hazime/');

// Add Include Path
// =======================
ini_set('include_path',ini_get('include_path') . ':' . $path);

// Require Hazime Root Class
// =======================
require_once 'class/Hazime.php';
$hazime = Hazime::getInstance( );

// Set UP Logger
// =======================
$hazime->setLogger(new Hazime_Log());

// Set Develop Mode
// =======================
$hazime->developMode();

// Set UP Boot Strap
// =======================
$bs = $hazime->getBootStrap();
$bs->addResourceDir($path .'/resource','Hazime_Resource');

// Get Website Resource
// =======================
$website = $bs->getWebsite();
$website->setLogger(new Hazime_Log());


// HTMLをビルドする
// ------------------------
$website->setHtmlDir(realpath(dirname(__FILE__).'/../html'));
$website->setDesignDir(realpath(dirname(__FILE__).'/../design'));
$website->addLayout('header','header.html');
$website->addLayout('footer','footer.html');
$website->addLayout('aside','profile.html');
$website->addLayout('aside_adv','adv.html');
$website->addLayout('contents','contents.html');
$website->build('main.html');

// デザイナー用に出力
// ------------------------
//$website->design('layout.html','index.html');

// デザイナーの更新を取り込む
// ------------------------

// レイアウトを解析する
// ------------------------
//$website->parseLayout("index.html",'main.html');
// パーツを解析する
// ------------------------
//$website->parseParts("index.html");



?>
