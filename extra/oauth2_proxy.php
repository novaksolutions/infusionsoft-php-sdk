<?php

session_start();

$allowedRedirectUrlPatterns = array(
    '/^https?:\/\/[a-z0-9]+\.novaksolutions\.com\//',
    '/^https?:\/\/[a-z0-9]+\.nlocal\.info\//',
    '/^https?:\/\/127\.0\.0\.1\//'
);

if(isset($_GET['authorizeUri'])){
    $allowed = false;
    foreach($allowedRedirectUrlPatterns as $pattern){
        if(preg_match($pattern, $_GET['redirectUri']) == 1){
            $allowed = true;
        }
    }

    if(!$allowed){
        throw new Exception("Ack! Rediret Uri Not Allowed");
        die();
    }

    $_SESSION['redirectUri'] = $_GET['redirectUri'];
    header("Location: {$_GET['authorizeUri']}");
} else {
    //Prepare redirct uri...
    header("Location: {$_SESSION['redirectUri']}?" . http_build_query($_GET));
}

