<?php

// Include the SDK
require_once('Infusionsoft/infusionsoft.php');

// Create a new contact object
$contact = new Infusionsoft_Contact();

// Set the contact fields
$contact->FirstName = 'Jacob';
$contact->LastName = 'Allred';
$contact->Email = 'jacob@novaksolutions.com';

// Save the contact to Infusionsoft
$contact->save();