<?php
/**
 * Contains Controller_Base
 * 
 */

namespace SmallPHPMVC;

/**
 * The base controller class. Contains a few helpful methods.
 * 
 */
abstract class BaseController {

	protected $registry;

	function __construct() {
		$this->registry = Registry::getReg();
	}

	/**
	 * Index is the default action of controllers, so it needs to be defined
	 */
	abstract function index();
}
