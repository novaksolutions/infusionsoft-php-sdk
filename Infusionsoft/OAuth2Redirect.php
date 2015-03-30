<?php
require_once ("Infusionsoft/infusionsoft.php");

$app = Infusionsoft_AppPool::addApp(new Infusionsoft_App(
		array("clientId" => "z3bf24482h647wxwvbtczp5m", "clientSecret" => "KRC53dmtzU", "redirectUri" => "https://systasis.co/infusionsoft.php")));

if (isset($_GET["code"]) and ! $oAuth2->getToken()) {
	$oAuth2Cache = new Infusionsoft_OAuth2Cache($oAuth2, $_GET["code"]);
}

if ($oAuth2->getToken()) {
	$oAuth2Cache->cacheData($oAuth2Cache->getData());
} else {
	echo '<a href="' . $oAuth2->getAuthorizationUrl() . '">Click here to authorize</a>';
}
