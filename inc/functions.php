<?php
/**
 * Globally useful functions
 * 
 * @package	ProfitTree
 */
 
function redirect($to){
	// Redirects page in case of refresh
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".$to);
	exit();
}

function dbquote($string, $search = false){
	$string = mysql_escape_string($string);
	if(trim($string) == ''){
		$return_string = 'NULL';
	}else{
		if($search){
			$return_string = "'%".$string."%'";
		}else{
			$return_string = "'".$string."'";
		}
	}

	return $return_string;
}

function dbbool($string){
	switch ($string){
		case '0':
			$return_string = 'FALSE';
			break;
		case '1':
			$return_string = 'TRUE';
			break;
		case '':
			$return_string = 'NULL';
			break;
		default:
			if($string){
				$return_string = 'TRUE';
			}else{
				$return_string = 'FALSE';
			}
			break;
	}

	return $return_string;
}