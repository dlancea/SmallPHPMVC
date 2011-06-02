<?php
/**
 * Globally useful functions
 * 
 * @package	MVC
 */
 

/**
 * For loading classes
 *
 * @param string $class_name
 * @return boolean  
 */
function __autoload($class_name) {
	// First underscore of class name is containing dir within "lib"
	$class_name_ex = explode('_', $class_name);

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

/**
 * Redirect client to new URL and stops execution of script.
 * 
 * @param string $to New URL
 */
function redirect($to){
	// Redirects page in case of refresh
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$to);
	exit();
}
