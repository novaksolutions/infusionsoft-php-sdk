<?php

require_once('Classloader.php');

/*
 * Load xmlrpc.inc if it isn't already loaded.
 *
 * We HIGHLY recommend using the included version. It contains a few additions
 * that work around bugs in the Infusionsoft API.
 */
if(!function_exists('xmlrpc_encode_entitites') && !class_exists('xmlrpcresp')) {
    require_once(__DIR__ . '/xmlrpc.inc');
}

$classLoader = new Infusionsoft_Classloader();
spl_autoload_register(array(&$classLoader, "loadClass"));

// Load config file if it exists. You can use the SDK without a config file.
if(file_exists(__DIR__ . '/config.php')){
    require(__DIR__ . '/config.php');
}
