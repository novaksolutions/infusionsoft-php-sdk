<?php

require_once('Classloader.php');
require_once('xmlrpc.inc');

$classLoader = new Infusionsoft_Classloader();
spl_autoload_register(array(&$classLoader, "loadClass"));

require('config.php');