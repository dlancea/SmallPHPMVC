<?php
/**
 * Example Index controller. This controller is loaded by default.
 */
namespace Controller;

use \SmallPHPMVC\Template;

class Index extends App {

	/**
	 * Example action. The "index" action is executed by default.
	 */
	function index() {

		$template = new Template('index');
		$template->set('greeting', 'Howdy!');
		$template->show();

	}
	
	/**
	 * Example action with parameters. Parameters are specified in the URL (eg. For "http://local/index/test/123/456", the
	 * parameter values are "123" for $arg and "456" for $arg2)
	 */
	function test($arg = null, $arg2 = null){
		echo 'Test action. $arg: '.$arg . ' arg2: ' . $arg2;
	}

	
	/**
	 * Only needed for the Index controller, since the index method acts like the PHP4 compatable constructor. 
	 */
	function __construct() {
		parent::__construct();
	}

}
