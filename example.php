<?php

/*
 *  _____   ____  _   _ _ _______   _    _  _____ ______   _______ _    _ _____  _____
 * |  __ \ / __ \| \ | ( )__   __| | |  | |/ ____|  ____| |__   __| |  | |_   _|/ ____|
 * | |  | | |  | |  \| |/   | |    | |  | | (___ | |__       | |  | |__| | | | | (___
 * | |  | | |  | | . ` |    | |    | |  | |\___ \|  __|      | |  |  __  | | |  \___ \
 * | |__| | |__| | |\  |    | |    | |__| |____) | |____     | |  | |  | |_| |_ ____) |
 * |_____/ \____/|_| \_|    |_|     \____/|_____/|______|    |_|  |_|  |_|_____|_____/
 *
 * This file was designed so that people could get up and running instantly WITHOUT composer.  Yes, you could use this in
 * production, but, it will overide other autoloaders, and generaly is not a good thing.  It's made to play with.
 */

$clientId = '';
$clientSecret = '';
//Go to: https://developer.infusionsoft.com/get-started/ to get your client id and secret

spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'NovakSolutions\\Infusionsoft';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/src/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});


ini_set('display_errors', 1);
error_reporting(E_ALL);

use NovakSolutions\Infusionsoft as Infusionsoft;

Infusionsoft\OAuth2::$clientId = $clientId;
Infusionsoft\OAuth2::$clientSecret = $clientSecret;

//For local development, using our OAuth2 proxy makes things easier.
Infusionsoft\OAuth2::$useProxy = true;
Infusionsoft\OAuth2::$proxy = 'https://proxy.novaksolutions.com/index.php';

if(isset($_GET['scope']) && isset($_GET['code'])){
    Infusionsoft\OAuth2::processAuthenticationResponse($_GET['scope'], $_GET['code'], false);
}

Infusionsoft\OAuth2::$redirectUri = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$app = Infusionsoft\App::connect('');
//If We Just Got Back From The OAuth Page...


if(!$app->hasTokens()){
    header("Location: " . Infusionsoft\OAuth2::getAuthorizationUrl());//Send To OAuth Page...
    die();
}

$results = Infusionsoft\DataService::query(Infusionsoft\Contact::blankClass(), array('FirstName' => '%'));

var_dump($results);