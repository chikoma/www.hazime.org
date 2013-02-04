#!/usr/bin/php
<?php
use Hazime\Hazime;
use Hazime\Application\Loader as AppLoader;
use Hazime\Request\Request as AppRequest;

require_once dirname(__FILE__).'/../lib/hazime/hazime.php';
Hazime::getInstance( )->register();

$file = $argv[1];
if($file == '-'){
	$file = 'php://stdin';
}

// Request
$req = AppRequest::factory('file',$file);
$parts      = explode('/',$req->url);

$app_name   = $parts[1];
$controller = $parts[2];
$action     = $parts[3];

// アプリケーションをロードする
$app = AppLoader::load(dirname(__FILE__).'/../applications/'.$app_name);

// リクエストをカスケード
$app->request( $req );

// アクションのディスパッチ
$app->action( $action, $controller );
?>
