<?php
namespace Application\Doc\Controller;
use Hazime\Application\Controller;

class Index extends Controller
{
	public function init( )
	{
		$this->view( )->layout('index');
	}
}
?>
