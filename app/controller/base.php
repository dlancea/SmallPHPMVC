<?php
abstract class Controller_Base {
	protected $registry;

	function __construct() {
		$this->registry = MVC_Registry::getReg();
	}

	abstract function index();

	function redirect($to) {
		header("Location: $to");
		exit ();
	}
}
