<?php
namespace App\Home;
use Hazime\Framework\Controller;

class IndexController extends Controller
{
	public function init( )
	{
		// Layoutの使用を宣言
		$this->view()->layout('layout.html');
	}

	public function actionIndex(  )
	{
		return self::SUCCESS;
	}
}
?>
