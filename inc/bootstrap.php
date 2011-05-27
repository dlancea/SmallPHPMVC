<?php
// Constants:
define ('DIRSEP', DIRECTORY_SEPARATOR);

// Get site path
$SITE_PATH = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

define ('SITE_PATH', $SITE_PATH);
define ('CONTROLLER_PATH', SITE_PATH.'controller');
define ('MODEL_PATH', SITE_PATH.'models');
define ('INCLUDE_PATH', SITE_PATH.'inc');
define ('LIBRARY_PATH', SITE_PATH.'lib');

// For loading classes
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