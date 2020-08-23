<?php
// Include the SDK
require_once('Infusionsoft/infusionsoft.php');
$appName = 'xx123.infusionsoft.com';
$apiKey = '123xyz';

//Initiate the Infusionsoft_App with API credentials
$app = new Infusionsoft_App($appName, $apiKey);

//Add the Infusionsoft App to the AppPool class
Infusionsoft_AppPool::addApp($app);


// Create a new contact object
$contact = new Infusionsoft_Contact(78649);

//Read a field from the loaded Contact object
$firstName = $contact->FirstName;

//Change a value on the loaded Contact object and save the change to Infusionsoft
$contact->FirstName = 'Bob';
$contact->save();


/**
 * Using the Infusionsoft_DataService::query method
 */

//Query using two different field criteria
$contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), array('FirstName' => 'Bob', 'LastName' => 'Doe'));

//Querying using an IN statement
$contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), array('Id' => array(3,5,7)));