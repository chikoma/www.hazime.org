 Hazime Lib
=============


 Application
----------------
機能をパッケージングする。
パッケージはブートストラップに依存し、
関係する全てのプログラムで、Bootstrapから呼び出す


# 構成するファイル
/controller
/config
bootstrap.php

## 設定例 /config/root.conf
	;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
	;;
	;; Astersik AMS Application
	;;
	;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

	;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
	;; 共通設定
	;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
	[general]
	namespace = Application\Asterisk

	;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
	;; Server Info Mation
	;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
	[server]
	; Asterisk Server Name
	host=phone.hazime.org
	; Asterisk Server Port
	port=5038
	; Username
	username=www
	; Secret
	secret=deganjue

## 例
フロントを使えば、沢山のアプリケーションをホールドし呼び出せる
	#!/usr/bin/php
	<?php
	use Hazime\Hazime;
	use Hazime\Application\Front\Front as Front;
	use Hazime\Application\Front\Command as Command;
	
	require_once dirname(__FILE__).'/../lib/hazime/hazime.php';
	Hazime::getInstance( )->register();
	
	$front = Front::factory('command',dirname(__FILE__).'/../config/front.conf');
	$front->run( );
	?>


 Pages
------------------
Webから使う為のページ郡

	pages/
		home/
			index.php <-- Pages\Home\IndexController
	view/
		layout/
			layout.html
		script/
			home/
				index.html

URLとの関係

/home/index

パスと同等のスクリプトが実行される。
フレームワーク的に使う場合は

applications/
	home/
		pages/
			index/
				index.php
		view/
			script/
				index.html
			layout/
				layout.html
