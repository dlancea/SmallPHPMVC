<?php
/**
 * Example Index controller. This controller is loaded by default.
 */

class Controller_Index extends Controller_Base {
	/**
	 * Example action. The "index" action is executed by default.
	 */
	function index() {
		$this->registry['template']->show('index');
	}
	
	/**
	 * Example action with parameters. Parameters are specified in the URL (eg. For "http://local/index/test/123/456", the
	 * parameter values are "123" for $arg and "456" for $arg2)
	 */
	function test($arg = null, $arg2 = null){
		echo 'Test action. $arg: '.$arg . ' arg2: ' . $arg2;
	}
}
