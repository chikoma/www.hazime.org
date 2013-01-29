<?php
$dir = realpath(dirname(__FILE__)."/../"); // uper app dir 
require_once dirname(__FILE__)."/../lib/header.php"; 
//
// Get Website Resource
// =======================
$website = $bs->website();

// HTMLをビルドする
// ------------------------
echo file_get_contents(APP_DIR.'/design/index.html');
?>
