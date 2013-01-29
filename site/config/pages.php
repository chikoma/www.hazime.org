<?php
$pages = array(
	'index'=> array(
		'layout'=>'main',
		'places'=>array()
	),
	'develop'=>array(
		'layout'=>'main',
		'places'=>array(
			'contents'=>'file://develop.html'
		)
	)
);
return $pages;
?>
