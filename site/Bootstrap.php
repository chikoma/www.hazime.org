<?php
require_once 'class/Bootstrap/Bootstrap.php';
define('APP_DIR',dirname(__FILE__));

class App_Bootstrap extends Hazime_Bootstrap
{
	protected function initWebsite( )
	{
		$website = $this->getResource('website');
		$website->init(array(
			'template_dir'=>APP_DIR.'/html',
			'design_dir'=>APP_DIR.'/design',
			'public_dir'=>APP_DIR.'/public'
		));
		$website->setLogger($this->logger());
		return $website;
	}
	protected function initLogger( )
	{
		return new Hazime_Log( );
	}

	protected function initView( )
	{
		$view = $this->getResource('view');
		$view->doctype('html5');
		$view->meta
			->charset('UTF-8')
			->keyword('不登校,登校拒否')
			->description('ハジメのサイト')
			->robots('index,follow')
			->author('Hajime MATSUMOTO')
			->copyright('Copyright Hajime MATSUMOTO Since 2013')
			->generator('hazime');
		$view->og
			->title('松本創とカムナガラ')
			->type('web')
			->description('解説')
			->url('http://www.hazime.org/'.$_SERVER['REQUEST_URI'])
			->image('http://www.hazime.org/assets/common/mascot.png')
			->site_name('松本創とカムナガラ')
			//->email('mail@hazime.org')
			//->phone_number('08088343232')
			;
		$view->title('松本創とカムナガラ');

		$view->style('assets/css/profile.css');
		//
		// コンテンツの初期設定
		//
		$view->place('adv')->load(APP_DIR.'/html/layout/main/default_adv.html');
		$view->place('contents')->load(APP_DIR.'/html/layout/main/default_contents.html');
		$view->place('sidebar')->load(APP_DIR.'/html/layout/main/default_sideber.html');

		return $view;
	}
}
?>
