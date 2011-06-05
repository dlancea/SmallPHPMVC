<?php
/**
 * Contains the Template class
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

	protected $_name = 'index';
	protected $_layout = null;
	
	/**
	 *
	 * @param string $name Name of the template to load
	 */
	public function __construct( $name = null ){
		if( $name ){
			$this->_name = $name;
		}
		
		$this->_layout = new Layout();
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

	function getLayout(){
		return $this->_layout;
	}

	function setLayout( Layout $layout ){
		$this->_layout = $layout;
	}
	
	/**
	 * Includes the template code into its own scope and and displays the template.
	 */
	function show() {
		$path = VIEW_PATH . DIRSEP . $this->_name . '.html.php';

		if (file_exists($path) == false) {
			throw new \Exception ('Template `' . $this->_name . '` does not exist.' );
		}

		// If there's no layout, simply include the template file and return.
		if(!$this->_layout){
			include ($path);
			return;
		}
		
		ob_start();
		include ($path);
		$template_output = ob_get_clean();

		$this->_layout->set('content', $template_output);
		$this->_layout->show();
	}
}

