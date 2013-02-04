<?php
namespace Hazime\Request;

class File extends Request
{
	public function __construct( $fp )
	{
		if(!is_resource($fp))
		{
			$fp = fopen($fp,'r');
		}
		flock($fp, LOCK_SH);

		// ヘッダーを探す
		$headers = array();
		while($line = fgets($fp, 1024))
		{
			if( $token = strtok(trim($line),':') )
			{
				$key = trim($token);
				$headers[strtolower($key)] = ltrim(strtok(':'));
			}elseif(!empty($key)){
				$headers[$key] .= ltrim($line);
			}
			if(trim($line) == ''){
				break;
			}
		}

		$this->url = $headers['url'];

		// ヘッダーが無かったら巻き戻し
		if(empty($headers)) rewind($fp);

		switch(strtolower($headers['encode']))
		{
		case 'json':
		default:
			$json = "";
			while($line = fgets($fp)){ 
				$json .= $line;
			} 
			$obj = json_decode(trim($json));
			break;
		}

		foreach($obj as $k=>$v) $this->set($k, $v);

		flock($fp, LOCK_UN);
		fclose($fp);
	}
}
?>
