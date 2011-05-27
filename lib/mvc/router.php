<?php
Class MVC_Router {
	private $registry;
	private $controller_path;
	private $args = array ();

	function __construct() {
		$this->registry = MVC_Registry::getReg();
	}

	function setPath($path) {
		$path = rtrim($path, '/\\');
		$path .= DIRSEP;

		if ( !is_dir($path) ) {
			throw new Exception('Invalid controller path: `' . $path . '`');
		}

		$this->path = $path;
	}

	function getArg($key) {
		if ( !isset($this->args[$key]) ) {
			return null;
		}
		return $this->args[$key];
	}

	function delegate() {
		// Analyze route (these args are pbr)
		$this->getController($file, $controller, $action, $args);

		// File available?
		if (is_readable($file) == false) {
			$this->notFound('no-file');
		}

		// Always include base controller
		require_once($this->path . DIRSEP . 'base.php');

		// Include the file
		include_once($file);

		// Initiate the class
		$class = 'Controller_' . $controller;
		$controller = new $class ($this->registry);

		// Action available?
		if (is_callable(array ($controller,	$action )) == false) {
			$this->notFound('no-action');
		}

		// Run action, esentailly does this: $controller->$action($args[0], $args[1], ...);
		// TODO -- How many arguments are expected? Give error if not enough (or too many) arguments given
		$method = new ReflectionMethod($controller, $action);
		
		$number_of_args = count($args);
		if( $number_of_args < $method->getNumberOfRequiredParameters() ){
			throw new Exception('Not enough arguments given to controller');
		}
		if( $number_of_args > $method->getNumberOfParameters() ){
			throw new Exception('Too many arguments given to controller');
		}
		
		call_user_func_array(array($controller, $action), $args);
	}

	private function extractArgs($args) {
		if (count($args) == 0) {
			return false;
		}
		$this->args = $args;
	}

	private function getController(& $file, & $controller, & $action, & $args) {
		$route = (empty ($_GET['r'])) ? '' : $_GET['r'];

		if (empty ($route)) {
			$route = 'index';
		}

		// Get separate parts
		$route = trim($route, '/\\');
		$parts = explode('/', $route);

		// Find right controller
		$cmd_path = $this->path;
		foreach ($parts as $part) {
			$fullpath = $cmd_path . $part;

			// Is there a dir with this path?
			if (is_dir($fullpath)) {
				$cmd_path .= $part . DIRSEP;
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

		if (empty ($controller)) {
			$controller = 'index';
		};

		// Get action
		$action = array_shift($parts);
		if (empty ($action)) {
			$action = 'index';
		}

		$file = $cmd_path . $controller . '.php';
		$args = $parts;
	}

	private function notFound() {
		// header('HTTP/1.1 404 Not Found');
		die("404 Not Found");
	}
}