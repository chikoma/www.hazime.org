<?php
namespace Hazime\Application\Front;
use Exception;
use Hazime\Config\Config;
use Hazime\Application\Loader as AppLoader;
use Hazime\Request\Request as AppRequest;

class Web extends Front
{
	private $_apps = array();

	public function run( )
	{
		$app_name   = 'doc';
		$controller = 'index';
		$action     = 'index';

		// アプリケーションをロードする
		$app = $this->app($app_name);

		// リクエストをカスケード
		//$app->request( $req );

		// アクションのディスパッチ
		$app->action( $action, $controller);
	}

}
?>
