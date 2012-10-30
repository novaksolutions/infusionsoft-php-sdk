<?php
    include('../infusionsoft.php');
    include('object_editor_all_tables.php');
    include('../tests/testUtils.php');

    Infusionsoft_SdkEventManager::attach('loaded', "DataObject.Loaded");
    Infusionsoft_SdkEventManager::attach('deleted', "DataObject.Deleted");
    Infusionsoft_SdkEventManager::attach('saved', "DataObject.Saved");
    Infusionsoft_SdkEventManager::attach('saved2', "DataObject.Saved");

    $contact = new Infusionsoft_Contact();
    $contact->FirstName = 'TEST';
    $contact->save();
    $contact2 = new Infusionsoft_Contact($contact->Id);
    $contact2->delete();

    function loaded($event){
        echo 'Loaded!<br/>';
    }

    function deleted(Infusionsoft_SdkEvent $event){
        echo 'Deleted!<br/>';
    }

    function saved(Infusionsoft_SdkEvent $event){
        echo 'Saved!<br/>';
    }

    function saved2(Infusionsoft_SdkEvent $event){
        echo 'Saved2!<br/>';
    }