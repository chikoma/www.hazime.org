<?php
/**
 * Export  Pages
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
	ob_start( );
	$bs->website->show($v);
	$contents = ob_get_contents( );
	ob_end_clean();

	$targ = $bs->website->designDir( ) .'/'.$k.'.html';

	if(file_exists($targ)){
		copy($targ,$targ."_bkuped_".time().".html");
	}

	file_put_contents( $targ, $contents);
}

?>
