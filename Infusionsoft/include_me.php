<?php
require('Classloader.php');
require('config.php');
require_once('misc/xmlrpc.inc');

$classLoader = new Infusionsoft_Classloader();
spl_autoload_register(array(&$classLoader, "loadClass"));

$appPool = new Infusionsoft_AppPool();

?>
