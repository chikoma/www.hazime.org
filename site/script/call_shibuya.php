#!/usr/bin/php
<?php
use Hazime\Logger\Logger;
include_once dirname(__FILE__).'/../lib/header.php';
$bs = new Bootstrap( );

$name = "masaru";

switch($name)
{
case "masaru":
$target = 'SIP/01097699061035@0000195886';
$to = '201*1';
$callerid = 'Report To Me <0363281591>';
break;
case "hajime":
$target = 'SIP/08088343232@0000195886';
$to = '201*1';
$callerid = 'Report To Me <0363281591>';
break;
case "taizo":
$target = 'SIP/203';
$to = 201;
$callerid = 'Report To Me <201>';
break;
}

$context = 'internal';
$interval = 10*60; // 30分に１回
do{
	set_time_limit($interval + 3600);
	$call = $bs->AMI->setLogger(new Logger())
		->command('Originate',
			array(
				'Channel' => $target,
				'Callerid' => $callerid,
				'Context' => $context,
				'Priority' => 1,
				'Exten' => $to
			)
		);
	if( $call['Response'] == 'Error' ) sleep( $interval );

}while($call['Response'] == 'Error');
?>
