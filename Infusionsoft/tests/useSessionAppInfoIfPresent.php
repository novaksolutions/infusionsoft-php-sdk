<?php
include('../infusionsoft.php');

if(isset($_SESSION['appHostName'])){
	Infusionsoft_AppPool::addApp(new Infusionsoft_App($_SESSION['appHostName'], $_SESSION['appKey'], $_SESSION['appPort']), 'default');
}