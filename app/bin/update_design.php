<?php
// app/bin/update_design
// =========================
// デザインをアップデートする
// =========================
//
//
// =========================
$dir = realpath(dirname(__FILE__)."/../"); // uper app dir 
require_once dirname(__FILE__)."/../lib/header.php"; 

echo "Updating Design\n\n";

// Update Design
$bs->website( )->parseLayout('index.html','main.html');
$bs->website( )->parseParts('index.html');
$bs->website( )->copyAssets( );

echo "\n\n\n";
?>
