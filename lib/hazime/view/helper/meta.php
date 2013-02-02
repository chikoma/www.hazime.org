<?php
namespace Hazime\View\Helper;

class Meta
{
	private $_metas;

	public function __construct( )
	{
		$this->charset('UTF-8');
	}

	public function charset( $charset )
	{
		$this->_metas['charset'] = array('charset'=>$charset);
		return $this;
	}

	public function property( $key, $value )
	{
		/*
		<meta property="og:title" content="さくらのVPS（CentOS）にNode.js環境を構築して遊ぶ">
		<meta property="og:description" content="3月末にプランリニューアルが行われてパワーアップした「さくらのVPS」を4月初めに契約。GW前半で計画していた作業が終了したこともあり、以前より興味を持っていたNode.jsをVPS上で環境構築して遊んでみることにしました。">
		<meta property="og:type" content="article">
		<meta property="og:locale" content="ja_JP">
		<meta property="og:url" content="http://www.skyward-design.net/blog/archives/000132.html">
		<meta property="og:image" content="http://www.skyward-design.net/shared/images/siteIdentity_s.gif">
		<meta property="og:site_name" content="Skyward Design">
		 */
		$this->_metas[$key] = array('property'=>$key, 'content'=>$value);
		return $this;
	}

	public function add($arr)
	{
		$this->_metas[] = $arr;
		return $this;
	}

	public function call( )
	{
		return $this;
	}

	public function __toString( )
	{
		$string = '';
		foreach( $this->_metas as $meta )
		{
			$string.='<meta ';
			foreach( $meta as $k=>$v ) $string.= sprintf(' %s="%s"', $k,$v );
			$string.=">\n";
		}
		return $string;
	}

}
?>
