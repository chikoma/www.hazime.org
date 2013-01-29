<?php
$dir = realpath(dirname(__FILE__)."/../"); // uper app dir 
require_once dirname(__FILE__)."/../lib/header.php"; 
//
// Get Website Resource
// =======================
$website = $bs->website();

// HTMLをビルドする
// ------------------------
$website->setVar('SUBTITLE','プロフィール');
$website->addLayout('header','header.html');
$website->addLayout('footer','footer.html');
$website->addLayout('aside','top-profile.html');
$website->addLayout('aside_adv','adv.html');
$website->addLayout('contents','profile.html');
$website->build('main.html');
?>
