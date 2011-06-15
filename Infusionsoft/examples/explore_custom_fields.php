<?php
    include('../infusionsoft.php');
	include('object_editor_all_tables.php');	
	include('../tests/testUtils.php');

    $customFields = Infusionsoft_CustomFieldService::getCustomFields(new Infusionsoft_Contact(), Infusionsoft_CustomFieldService::$DataType_Dropdown);
    var_dump($customFields);

    foreach($customFields as $customField){
        if($customField->Name == 'Test'){
            $customFieldValues = $customField->getCustomFieldValues();
            $customFieldValues[] = rand(1, 100) . ' Value';
            $customField->setCustomFieldValues($customFieldValues);
            //$customField->save();
        }
    }

    $customField = Infusionsoft_CustomFieldService::getCustomField(new Infusionsoft_Contact(), 'Test');
    var_dump($customField);
