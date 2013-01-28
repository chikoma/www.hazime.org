<?php
// app/bin/update_design
// =========================
// デザインをかき戻す
// =========================
//
//
// =========================
$dir = realpath(dirname(__FILE__)."/../"); // uper app dir 
require_once dirname(__FILE__)."/../lib/header.php"; 

echo "BackDate Design\n\n";

// Update Design

// INDEX:HTMLをビルドする
// ------------------------
$bs->website()->addLayout('header','header.html');
$bs->website()->addLayout('footer','footer.html');
$bs->website()->addLayout('aside','profile.html');
$bs->website()->addLayout('aside_adv','adv.html');
$bs->website()->addLayout('contents','contents.html');
$bs->website()->build('main.html');
$bs->website()->design('main.html','index.html');


// PROFILE:HTMLをビルドする
// ------------------------
$bs->website()->addLayout('contents','profile.html');
$bs->website()->build('main.html');
$bs->website()->design('main.html','profile.html');

// 開発日記:HTMLをビルドする
// ------------------------
$bs->website()->addLayout('contents','develop.html');
$bs->website()->build('main.html');
$bs->website()->design('main.html','develop.html');
echo "\n\n\n";
?>
