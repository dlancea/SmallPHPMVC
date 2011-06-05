<?php
/**
 * Contains the MVC_Template class
 * 
 */
namespace SmallPHPMVC;

/**
 * A simple template engine. 
 * 
 * The set function sets variable used by the template.
 * The remove function removes previously set variables.
 * The show function includes the template code into its own scope and and displays the template.
 * 
 * @author David Lancea
 */
class Template {

	protected $__template_name = 'index';
	
	public function __construct($name = null){
		if( $name ){
			$this->__template_name = $name;
		}
	}
	
	/**
	 * Sets variable used by the template.
	 * 
	 * @param string $varname
	 * @param mixed $value
	 * @param booliean $overwrite Allow overwrite of previously set variable
	 */
	function set($varname, $value, $overwrite=false) {
		if (isset($this->$varname) == true AND $overwrite == false) {
			throw new \Exception ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.');
		}

		$this->$varname = $value;
	}

	/**
	 * Removes a previously set variable
	 *
	 * @param string $varname
	 */
	function remove($varname) {
		unset($this->$varname);
	}

	/**
	 * Includes the template code into its own scope and and displays the template.
	 */
	function show() {
		$path = VIEW_PATH . DIRSEP . $this->__template_name . '.html.php';

		if (file_exists($path) == false) {
			throw new \Exception ('Template `' . $this->__template_name . '` does not exist.' );
		}

		include ($path);		
	}

}
