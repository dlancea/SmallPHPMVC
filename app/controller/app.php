<?php
/**
 * Contains Controller_App
 * 
 */
namespace Controller;

/**
 * An application specific implementation of SmallPHPMVC\BaseController. Contains methods 
 * you would want in every controller. 
 */
abstract class App extends \SmallPHPMVC\BaseController {
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * Perform an HTTP redirect to new URL. Stops execution.
	 * @param string $to 
	 */
	function redirect($to) {
		header("Location: $to");
		exit();
	}


}
