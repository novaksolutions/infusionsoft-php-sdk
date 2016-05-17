<?php
include('../infusionsoft.php');

$linkedContactTypes = Infusionsoft_DataService::query(new Infusionsoft_LinkedContactType(), array('Id' => '%'));

var_dump($linkedContactTypes);

//Soon I hope...
//
//$linkedContacts = Infusionsoft_DataService::query(new Infusionsoft_LinkedContact(), array('Id' => '%'));
//
//var_dump($linkedContacts);