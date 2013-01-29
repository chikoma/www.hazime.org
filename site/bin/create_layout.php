<?php
/**
 * Create Layout
 * ==========================================
 * Html FileからLayoutファイルを作成する
 *
 *
 * ==========================================
 */
require_once dirname(__FILE__).'/../lib/header.php';

function usage( ){
	global $argv;
	echo <<<EOF
Usage:
	{$argv[0]} <input file> <layout name>
EOF;

	die();
}

$file = @$argv[1];
$name = @$argv[2];

if( empty($file) || empty($name) ){
	usage();
}

// Desinerの取得
$layout = $bs->website
	->designer( )
	->setLogger(new Hazime_Log)
	->createLayout($file, $bs->website->layoutDir(), $name)
?>
