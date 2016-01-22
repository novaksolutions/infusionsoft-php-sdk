<?php
include('../infusionsoft.php');

$contact = new Infusionsoft_Contact();

$customFields = Infusionsoft_CustomFieldService::getCustomFields(new Infusionsoft_Contact());

/** @var Infusionsoft_DataFormField $customField */
$customFieldsAsArray = array();
foreach($customFields as $customField){
    $customFieldsAsArray[] = '_' . $customField->Name;
}

$contact->addCustomFields($customFieldsAsArray);

$contacts = Infusionsoft_DataService::queryWithOrderBy(new Infusionsoft_Contact(), array('Id' => '%'), 'LastUpdated', 1, 1, array('Id'));

var_dump($contacts);