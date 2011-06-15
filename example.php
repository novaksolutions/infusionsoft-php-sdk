<?php

$inf = new Infusionsoft();

//Plain load of a contact
$data = $inf->Data('Contact');
$data->load(9377);
$data->LastName = 'Test';
$data->save();


//Looping through
$data = $inf->Data('Contact');


foreach($data->query(array('LastName'=>'Test')) as $contact)
{
	$contact->LastName = 'Gales';
	$contact->save();
}

