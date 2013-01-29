<?php
/**
 * Index PHP
 * ==========================================
 *
 *
 * ==========================================
 */
require_once dirname(__FILE__).'/../lib/header.php';
// ページ情報
$title = "トップページ";
$desc = "松本創のトップ";
$keyword = "松本創";

$bs->view->meta->keyword($keyword);
$bs->view->meta->title($title);
$bs->view->meta->description($desc);
$bs->view->title->append($title);
$bs->view->place('contents')->start();
?>


<?php
$bs->view->place('contents')->end();
// Themeを実行
$bs->view->execute(APP_DIR.'/theme/default/theme.html');
?>
