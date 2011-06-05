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

	protected $_template_name = 'index';
	protected $_is_layout = false;
	
	/**
	 *
	 * @param string $name Name of the template to load
	 */
	public function __construct($name = null, $is_layout = false){
		if( $name ){
			$this->_template_name = $name;
		}
		$this->_is_layout = $is_layout;
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
		$path = VIEW_PATH . DIRSEP . $this->_template_name . '.html.php';

		if (file_exists($path) == false) {
			throw new \Exception ('Template `' . $this->_template_name . '` does not exist.' );
		}

		// TODO, make layout class.
		if( $this->_is_layout ){
			include ($path);
		}else{
			ob_start();
			include ($path);
			$template_output = ob_get_clean();
			
			$layout = new Template('layout/default', true);
			$layout->set('content', $template_output);
			$layout->show();			
		}
	}
}
