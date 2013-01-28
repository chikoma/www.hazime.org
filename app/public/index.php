<?php
$dir = realpath(dirname(__FILE__)."/../"); // uper app dir 
require_once dirname(__FILE__)."/../lib/header.php"; 
//
// Get Website Resource
// =======================
$website = $bs->website();


// HTMLをビルドする
// ------------------------
$website->setVar('SUBTITLE','トップ');
$website->addLayout('header','header.html');
$website->addLayout('footer','footer.html');
$website->addLayout('aside','profile.html');
$website->addLayout('aside_adv','adv.html');
$website->addLayout('contents','index.html');
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
