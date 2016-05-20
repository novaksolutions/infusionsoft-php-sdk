<?php
include('../infusionsoft.php');

$linkedContactTypes = Infusionsoft_DataService::query(new Infusionsoft_LinkedContactType(), array('Id' => '%'));

var_dump($linkedContactTypes);
$firstType = array_shift($linkedContactTypes);

$contactA = new Infusionsoft_Contact(68665);

$contactB = new Infusionsoft_Contact(68667);

Infusionsoft_ContactService::linkContacts($contactA->Id, $contactB->Id, $firstType->Id);

//What happens with an Invalid Link...
$out = Infusionsoft_ContactService::linkContacts($contactA->Id, 12039875, $firstType->Id);
var_dump($out);

//What happens with an Invalid Link...
$out = Infusionsoft_ContactService::linkContacts($contactA->Id, 12039875, $firstType->Id);
var_dump($out);
//
//$linkedContacts = Infusionsoft_DataService::query(new Infusionsoft_LinkedContact(), array('Id' => '%'));
//
//var_dump($linkedContacts);

$linkedContacts = Infusionsoft_ContactService::listLinkedContacts($contactB->Id);
var_dump($linkedContacts);