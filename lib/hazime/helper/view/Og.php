<?php
/**
 * OGの種類
 * <meta property="og:title" content="松本創とカムナガラ">
 * <meta property="og:type" content="web">
 * <meta property="og:description" content="解説">
 * <meta property="og:url" content="">
 * <meta property="og:image" content="index.png">
 * <meta property="og:site_name" content="松本創とカムナガラ">
 * <meta property="og:email" content="mail@hazime.org">
 * <meta property="og:phone_number" content="08088343232">
echo $bs->view->og
	->title('松本創とカムナガラ')
	->type('web')
	->description('解説')
	->url($_SERVER['PHP_SELF'])
	->image('index.png')
	->site_name('松本創とカムナガラ')
	->email('mail@hazime.org')
	->phone_number('08088343232');
 */
class Hazime_View_Helper_Og
{
	private $_metas = array();
	private $_ogs = array();

	public function __construct( $view )
	{
	}

	public function helper( )
	{
		return $this;
	}

	public function __call( $name, $args )
	{
		$this->_ogs[$name] = $args[0];
		return $this;
	}

	public function __toString( )
	{
		$output = "";
		foreach( $this->_ogs as $k=>$v )
		{
			$output.= sprintf('<meta property="og:%s" content="%s">'."\n",$k,$v);
		}
		return $output;
	}
}
?>
