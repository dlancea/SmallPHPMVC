<?php
/**
 * Contains MVC_Registry class
 * 
 */

/**
 * A singleton registry class which can hold application-wide settings.
 * 
 * Example:
 * <code>
 *	$registry = MVC_Registry::getReg();
 *	$db = <db setup>;
 *	$registry->set('db', $db);
 *	OR
 *	$registry['db'] = $db;
 * 
 * 
 *	// Somewhere else in the application...
 *	$registry = MVC_Registry::getReg();
 *	$db = $registry->get('db');
 *	OR
 *	$db = $registry['db'];
 * </code>
 * 
 * @author David Lancea
 */
Class MVC_Registry Implements ArrayAccess {
	private $vars = array();
	private static $instance = null;

	function __construct() {
	}

	// Make this class a singleton
	static function getReg(){
		if(self::$instance == null){
			self::$instance = new MVC_Registry();
			return self::$instance;
		}else{
			return self::$instance;
		}
	}

	function set($key, $var) {
		if (isset($this->vars[$key]) == true) {
			throw new Exception('Unable to set var `' . $key . '`. Already set.');
		}

		$this->vars[$key] = $var;
		return true;
	}

	function get($key) {
		if (isset($this->vars[$key]) == false) {
			return null;
		}

		return $this->vars[$key];
	}

	function remove($key) {
		unset($this->vars[$key]);
	}

	function offsetExists($offset) {
		return isset($this->vars[$offset]);
	}

	function offsetGet($offset) {
		return $this->get($offset);
	}

	function offsetSet($offset, $value) {
		$this->set($offset, $value);
	}

	function offsetUnset($offset) {
		unset($this->vars[$offset]);
	}
}