<?php
/**
 * Import Pages
 * ==========================================
 *
 *
 * ==========================================
 */
require_once dirname(__FILE__).'/../lib/header.php';

// Pages
$pages = include_once APP_DIR .'/config/pages.php';

foreach($pages as $k=>$v )
{
	$places = $bs->website->designer( )->getPlaces( $k.".html" );
	foreach($v['places'] as $kk=>$vv )
	{
		if(0 === substr_compare('file://',$vv,0,7)){
			file_put_contents(
				$bs->website->htmlDir().'/files/'.$k.".html",$places[$kk]
			);
		}
	}
}

?>
