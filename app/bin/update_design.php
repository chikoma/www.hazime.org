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

// Layoutを取得する
// =====================
//$bs->website( )->parseLayout('index.html','main.html');

//
// 解析レシピ
//
$i = 0;
$files[$i]['file']                = 'index.html';
$files[$i]['blocks']['contents']  = 'index.html';
$files[$i]['blocks']['header']    = 'header.html';
$files[$i]['blocks']['aside']     = 'profile.html';
$files[$i]['blocks']['aside_adv'] = 'adv.html';
$files[$i]['blocks']['footer']    = 'footer.html';
$files[$i]['replace'] = array(
	array('/\{\$(.*)\}/','<?php echo $this->getVal("\1"); ?>'),
);
$i++;

$i = 0;
$layouts[$i]['file'] = 'index.html';
$layouts[$i]['name'] = 'main.html';
$layouts[$i]['replace'] = array(
	array('/\{\$(.*)\}/','<?php echo $this->getVal("\1"); ?>'),
);
$i++;

$bs->website()->importLayout( $layouts );
$bs->website()->importContents( $files );

echo "\n\n\n";
?>
