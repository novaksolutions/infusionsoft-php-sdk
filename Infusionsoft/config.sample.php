<?php

$infusionsoft_host = 'joey.infusionsoft.com';

//deprecated - Keap are sunsetting legacy Keys Oct 2024 - Comment out this line once you have set up your new SAK key
$infusionsoft_api_key = 'YOUR API KEY GOES HERE';

//Uncomment the following line once you have generated and copied in your SAK key
//$infusionsoft_sak_key = 'YOUR SERVICE ACCESS KEY (SAK) GOES HERE'; 


//To Add Custom Fields, use the addCustomField method like below.
//Infusionsoft_Contact::addCustomField('_LeadScore');

//Below is just some magic...  Unless you are going to be communicating with more than one APP at the SAME TIME.  You can ignore it.

//Comment this line out once you have set up your new SAK key
Infusionsoft_AppPool::addApp(new Infusionsoft_App($infusionsoft_host, $infusionsoft_api_key, 443));

//Uncomment the following line once you have generated and copied in your SAK key above
//Infusionsoft_AppPool::addApp(new Infusionsoft_App($infusionsoft_host, $infusionsoft_sak_key, 443));