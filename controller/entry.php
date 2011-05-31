<?php
/**
 * Profit Tree controller
 *
 * @package		default
 */

class Controller_Entry extends Controller_Base {
	function index() {
		echo 'entry test!';
	}
	
	function test($arg = null, $arg2 = null){
		echo 'this function'.$arg . 'arg2: ' . $arg2;
	}
}
