<?php
$dir = realpath(dirname(__FILE__)."/../../");
ini_set('include_path', ini_get('include_path').':'.$dir."/lib/xmphp");
ini_set( 'display_errors', 1 );


include "XMPPHP/XMPP.php";

#Use XMPPHP_Log::LEVEL_VERBOSE to get more logging for error reports
#If this doesn't work, are you running 64-bit PHP with < 5.2.6?
//$conn = new XMPPHP_XMPP('im.hazime.org', 5222, 'kurari', 'deganjue', 'xmpphp', 'im.hazime.org', $printlog=false, $loglevel=XMPPHP_Log::LEVEL_INFO);
//$conn = new XMPPHP_XMPP('im.hazime.org', 5222, 'kurari', 'deganjue', 'xmpphp', 'im.hazime.org', $printlog=false, $loglevel=XMPPHP_Log::LEVEL_VERBOSE);
$conn = new XMPPHP_XMPP('176.34.61.194', 5222, 'kurari', 'deganjue', 'php','im.hazime.org');


try {
    $conn->connect();
    $conn->processUntil('session_start');
    $conn->presence();
    $conn->message('hajime@avap.co.jp', 'This is a test message!');
    $conn->disconnect();
} catch(XMPPHP_Exception $e) {
    die($e->getMessage());
}

?>
