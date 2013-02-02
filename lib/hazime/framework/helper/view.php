<?php
namespace Hazime\Framework\Helper;
use Hazime\View\View as Hazime_View;

class View extends Hazime_View
{
	private $_caller;

	public function call( $caller )
	{
		$this->_caller = $caller;
		return $this;
	}

	public function display( Response $resp )
	{
		$view_script = sprintf('%s/%s.html',
			$resp->info->controller_name,
			$resp->info->action_name
		);

		$view_dir = $this->_caller->getModuleDir(
			$resp->info->module_name
		).'/view';

		$this->setViewDir( $view_dir );

		parent::display( $view_script );
	}
}
?>
