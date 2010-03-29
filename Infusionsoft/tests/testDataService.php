<?php
include('../include_me.php');
$out = Infusionsoft_DataService::findByField(Infusionsoft_AppPool::getApp(), new Infusionsoft_Contact(), 'FirstName', 'Joey', 1);
?><pre><?php 
var_dump($out);
?></pre>