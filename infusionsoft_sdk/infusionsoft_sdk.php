<?php
include('config.php');
require_once('misc/xmlrpc.inc');

//add the infusionsoft autoload function to the spl stack.
spl_autoload_register(infusionsoft_autoload);

function infusionsoft_autoload($class_name) {
	$out = false;
	if(file_exists(dirname(__FILE__) . '/classes/' . strtolower($class_name) . '.php')){
		require 'classes/' . strtolower($class_name) . '.php';
		$out = true;	
	}    
	return $out;
}
?>
