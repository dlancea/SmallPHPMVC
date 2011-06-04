<?php
/**
 * Contains MVC_Router class
 */

/**
 * Routes the execution of a page load to the appropreate controller method, based
 * on GET parameters.
 * 
 * @author David Lancea
 */
Class MVC_Router {

	protected $get_var_name = 'url';
	protected $controller_path = 'controller/';

	/**
	 * Constructor
	 * 
	 */
	function __construct($options = array()) {
		$this->get_var_name = $options['get_var_name'] ?: $this->get_var_name;
		$this->controller_path = $options['controller_path'] ?: $this->controller_path;
	}

	/**
	 * Set path to controllers. Default is ./controller/
	 * @param type $path 
	 */
	function setPath($path) {
		$path = rtrim($path, '/\\');
		$path .= DIRSEP;

		if ( !is_dir($path) ) {
			throw new Exception('Invalid controller path: `' . $path . '`');
		}

		$this->controller_path = $path;
	}

	/**
	 * Determine the controller and action path, then load and execute that action, passing 
	 * any additional vairables to it.
	 * 
	 */
	function delegate() {
		// Analyze route
		$route = $this->decodeRoute( $_GET[$this->get_var_name] );

		// File available?
		if (is_readable($route['file']) == false) {
			$this->notFound('no-file');
		}

		// Always include base controller
		require_once($this->controller_path . DIRSEP . 'base.php');

		// Include the file
		include_once($route['file']);

		// Initiate the class
		$class = 'Controller_' . $route['controller'];
		$controller_obj = new $class();

		// Action available?
		if (is_callable(array ($controller_obj,	$route['action'] )) == false) {
			$this->notFound('no-action');
		}

		// Check for number of arguments
		$method = new ReflectionMethod($controller_obj, $route['action']);
		
		$number_of_args = count($route['additional_arguments']);
		if( $number_of_args < $method->getNumberOfRequiredParameters() ){
			throw new Exception('Not enough arguments given to controller. ' . $method->getNumberOfRequiredParameters() . ' required.');
		}
		if( $number_of_args > $method->getNumberOfParameters() ){
			throw new Exception('Too many arguments given to controller. ' . $method->getNumberOfParameters() . ' expected.');
		}
		
		// Run action, esentailly does this: $controller_obj->$route['action']($args[0], $args[1], ...);
		call_user_func_array(array($controller_obj, $route['action']), $route['additional_arguments']);
	}

	/**
	 * Used to determine controller file, controller name, action name, and additional arguments
	 * for requested URL
	 * 
	 * @param string A partial URI for a controller, action, and additional parameters separated by
	 * forward slashes. Example: controller/action/param1/param2
	 * @return array Associative array containing:
	 * 'file', 'controller', 'action', 'additional_arguments' 
	 */
	private function decodeRoute($route) {
		// Get separate parts
		$route = trim($route, '/\\');
		$parts = explode('/', $route);

		// Controller might be in a subdirectory of controller dir. This will search down the
		// array of routing "parts" till it either finds a matching file
		$current_path = $this->controller_path;
		$controller = '';
		foreach ($parts as $part) {
			$fullpath = $current_path . $part;

			// Is there a dir with this path?
			if (is_dir($fullpath)) {
				$current_path .= $part . DIRSEP;
				array_shift($parts);
				continue;
			}

			// Find the file
			if (is_file($fullpath . '.php')) {
				$controller = $part;
				array_shift($parts);
				break;
			}
		}

		// Get action
		$action = array_shift($parts);

		// Set default $controller to index
		if(!$controller)
			$controller = 'index';
		
		// Set default $action to index
		if(!$action)
			$action = 'index';


		$args = $parts;
		
		$return['controller'] = $controller;
		$return['action'] = $action;
		$return['additional_arguments'] = $parts;
		$return['file'] = $current_path . $controller . '.php';
		
		return $return;
	}

	private function notFound() {
		header('HTTP/1.1 404 Not Found');
		// die("404 Not Found");
	}
}