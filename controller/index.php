<?php
/**
 * Profit Tree controller
 *
 * @package		default
 */

class Controller_Index extends Controller_Base {
	function index() {
		$this->registry['template']->show('index');
	}
	
	function test($arg = null, $arg2 = null){
		echo 'this function'.$arg . 'arg2: ' . $arg2;
	}
}
