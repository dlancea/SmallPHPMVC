<?php

Class MVC_Template {
	private $_registry;

	function __construct() {
		$this->_registry = MVC_Registry::getReg();
	}

	function set($varname, $value, $overwrite=false) {
		if (isset($this->$varname) == true AND $overwrite == false) {
			trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
			return false;
		}

		$this->$varname = $value;
		return true;
	}

	function remove($varname) {
		unset($this->$varname);
		return true;
	}

	function show($name) {
		$path = SITE_PATH . 'template' . DIRSEP . $name . '.php';

		if (file_exists($path) == false) {
			trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
			return false;
		}

		include ($path);		
	}

}