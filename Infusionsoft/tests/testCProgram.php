<?php
	include("../infusionsoft.php");
	include('testUtils.php');
	
	$out = Infusionsoft_DataService::findByField(new Infusionsoft_CProgram(), 'Id', '1', '1', '0', array('Id'));
	
	var_dump($out);