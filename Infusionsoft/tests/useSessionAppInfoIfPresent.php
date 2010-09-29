<?php
if(session_id() == ''){
	session_start();
}
require_once('../infusionsoft.php');

if(isset($_SESSION['appHostName'])){		
	Infusionsoft_AppPool::addApp(new Infusionsoft_App($_SESSION['appHostName'], $_SESSION['appKey'], $_SESSION['appPort']));	
}