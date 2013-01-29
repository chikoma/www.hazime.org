<?php
/**
 * Index PHP
 * ==========================================
 *
 *
 * ==========================================
 */
require_once dirname(__FILE__).'/../lib/header.php';
$pages = include_once APP_DIR.'/config/pages.php';
$bs->website->show($pages['develop']);
?>
