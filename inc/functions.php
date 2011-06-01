<?php
/**
 * Globally useful functions
 * 
 * @package	MVC
 */
 
function redirect($to){
	// Redirects page in case of refresh
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$to);
	exit();
}
