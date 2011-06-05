<?php
/**
 * Contains the Layout class
 * 
 */
namespace SmallPHPMVC;

/**
 * A simple layout engine. 
 * 
 * This is a variation on the Template class, except it does not have a layout of its own.
 * 
 * @author David Lancea
 */
class Layout extends Template {

	protected $_name = 'layout/default';
	
	/**
	 *
	 * @param string $name Name of the template to load
	 */
	public function __construct($name = null){
		if( $name ){
			$this->_name = $name;
		}
	}

	/**
	 * Includes the template code into its own scope and and displays the template.
	 */
	function show() {
		$path = VIEW_PATH . DIRSEP . $this->_name . '.html.php';

		if (file_exists($path) == false) {
			throw new \Exception ('Layout `' . $this->_name . '` does not exist.' );
		}

		include ($path);
	}
}
