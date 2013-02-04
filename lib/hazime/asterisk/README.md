サンプル
==============

	$ams = new Manager();
	$ams->setLogger(new Logger());
	$ams->connect('phone.hazime.org',5038,'www','deganjue');
	//$ams->command('ListCommands');
	//$ams->command('Reload');
	$ams->command('Originate',array(
		'Channel'=>'SIP/202',
		'Callerid'=>'Hazime <201>',
		'Context'=>'201-out',
		'Priority'=>1,
		'Async'=>1,
		'Exten'=>'201*1'
	));
