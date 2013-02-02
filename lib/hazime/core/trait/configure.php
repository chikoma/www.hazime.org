<?php
namespace Hazime\Core;

trait Configure
{
	/**
	 * Import Configuration
	 */
	public function configure( $options )
	{
		foreach($options as $k=>$v )
		{
			$this->set($k,$v);
		}
		return $this;
	}

	/**
	 * Set Config
	 */
	public function set($k,$v)
	{
		if(method_exists($this,$method = 'set'.implode(explode('_',$k)))){
			return $this->$method($v);
		}
		return $this;
	}
}
?>
