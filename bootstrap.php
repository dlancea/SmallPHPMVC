<?php
namespace SmallPHPMVC;

// Constants:
define ('DIRSEP', DIRECTORY_SEPARATOR);

define ('SITE_PATH', realpath(dirname(__FILE__) . DIRSEP . '../..' . DIRSEP) . DIRSEP );
define ('INCLUDE_PATH', SITE_PATH.'inc');
define ('LIBRARY_PATH', SITE_PATH.'lib');

define ('APP_PATH', SITE_PATH . 'app/');
define ('CONTROLLER_PATH', APP_PATH.'controller');
define ('MODEL_PATH', APP_PATH.'models');
define ('VIEW_PATH', APP_PATH.'view');

class Bootstrap {
	public static function initialize(){
		// Setup autoloader
		spl_autoload_register('SmallPHPMVC\Bootstrap::loader');
		
		// Setup Registry and delagate application execution.
		$registry = Registry::getReg();

		# Connect to DB
		// Setup DB here... or don't
		// $db = new PDO('mysql:host=myhost;dbname=mydb', 'login', 'password'); 
		// $registry->set('db', $db);
		// 
		// OR
		// 
		// $mongo = new Mongo();
		// $db = $mongo->mongo_db;
		// $registry->set('db', $db);

		# Load router
		$router = new Router();
		$router->setPath (CONTROLLER_PATH);
		$router->delegate();
	}
	
	/**
	 * For loading classes
	 *
	 * @param string $class_name
	 * @return boolean  
	 */
	static function loader($class_name) {
		
		// First underscore of class name is containing dir within "lib"
		$class_name_ex = explode('\\', $class_name);

		$first = array_shift($class_name_ex);
		$first = strtolower($first);

		$filename =  strtolower(implode('_', $class_name_ex)) . '.php';

		// check library dir first
		if (file_exists(LIBRARY_PATH . DIRSEP . strtolower($first) . DIRSEP . $filename)) { 
			$file = LIBRARY_PATH . DIRSEP . strtolower($first) . DIRSEP . $filename;
		}elseif( file_exists(strtolower($first) . DIRSEP . $filename) ){
			$file = strtolower($first) . DIRSEP . $filename;
		}else{
			return false;
		}

		include($file);
	}
}


