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
<section id="welcome" class="text_content text_content_first">
	<article>
		<header>
			<h1>Welcome Message - ようこそ</h1>
		</header>
		<section>
			<p>
				来訪ありがとうございます。
				ここは、松本創（ハジメ）のWEBサイトです。
				主な目的は僕個人の情報発信と、
				WEBを使った実験をしてゆきたいと思っています。
				WEB開発に興味がある方、サイト主を知っている方、
				不登校に興味がある方、モンゴル投資に、IT開発に・・・
				勝手に進んでゆくので、興味の方向に任せて見守ってください。
				<small>2013年1月29日 ハジメ</small>
			</p>
		</section>
	</article>
</section><!-- /welcom -->

<section id="news" class="text_content text_content_list">
	<article class="first">
		<header>
			<h1>「しょうがねぇじゃん俺生きてるし」がKndleストアへ</h1>
			<hgroup class="info">
				カテゴリ[NEWS]
			</hgroup>
		</header>
		<section>
			<p>
				1999年に河出書房新社から出版した著書を電子化出版しました。
				山田洋次監督の学校Ⅳ原案にもなった本で、
				「不登校から立ち直って偉いわね」と言われる度に、
				立ち直ってなんかいない。
				だって、どんなレールにも戻ってないし、
				転がるように不登校から始まった歴史を歩み続けてるだけだし。
				という想いを伝えたくて、書いた本です。
			</p>
		</section>
	</article>
	<article>
		<header>
			<h1>メールアドレス登録のお願い</h1>
			<hgroup class="info">
				カテゴリ[NEWS]
			</hgroup>
		</header>
		<section>
			<p>
				サイトの活動や、本人の活動のお知らせを送付します。　
			</p>
		</section>
	</article>
	<article>
		<header>
			<h1>「かむながら」復活計画：始動</h1>
			<hgroup class="info">
				カテゴリ[NEWS・かむながら]
			</hgroup>
		</header>
		<section>
			<p>
				日常の中に非日常を！僕らはただ生きてるだけじゃない。
				会社、学校、単なる社会生活以外のつながり、
				活動が必要だ！そんな言葉はきっと「かむながら」の
				コンセプトの一つ。
				出たとこ勝負、発想次第の「かむながら」活動内容も、
				参加者次第。そんな集まりです。
			</p>
		</section>
	</article>
</section><!-- /news -->
<?php
$bs->view->place('contents')->end();
// Themeを実行
$bs->view->execute(APP_DIR.'/theme/default/theme.html');
?>
