Asterisk Manager Intarface
==============================

30分に一度,10時から20時までの間、
月曜日から金曜日まで。

報告を収集するコマンドmasaru.cmdを実行する。

Command File
----------------------
	$ cat masaru.cmd
	Url :  /asterisk/ami/call
	Encode : Json

	{
		"channel":"SIP/01097699061035@0000195886";
		"exten":"201*1",
		"context":"internal",
		"callerid":"Reportto me <0363281591>"
	}

JobをCronに登録
----------------------
	$ crontab -e
	*/30 10-20 * * mon/tue/wed/thu/fri /path/to/execute.php /path/to/masaru.cmd↲
