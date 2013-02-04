<?php
namespace Hazime\Application\Front;
use Exception;
use Hazime\Config\Config;
use Hazime\Application\Loader as AppLoader;
use Hazime\Request\Request as AppRequest;

class Command extends Front
{
	private $_apps = array();

	public function run( )
	{
		global $argv;

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
		$app = $this->app($app_name);

		// リクエストをカスケード
		$app->request( $req );

		// アクションのディスパッチ
		$app->action( $action, $controller);
	}

}
?>
