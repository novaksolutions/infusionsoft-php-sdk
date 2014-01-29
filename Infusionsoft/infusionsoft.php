<?php

require_once('Classloader.php');

if(!function_exists('xmlrpc_encode_entitites') && !class_exists('xmlrpcresp')) {
	require_once('xmlrpc.inc');
}

$classLoader = new Infusionsoft_Classloader();
spl_autoload_register(array(&$classLoader, "loadClass"));

require('config.php');
