<?php
include('../infusionsoft.php');
include('testUtils.php');
?>
<h1>Testing Save With New Contact</h1>
<?php 
$contact = new Infusionsoft_Contact();
$contact->FirstName = 'Joey';

$out = Infusionsoft_ContactService::save($contact);
?>
<pre><?php didItWorkInt($out); ?></pre>

<h1>Testing Save With Existing Contact</h1>
<?php 
$contact->FirstName = 'Joey';

$out = Infusionsoft_ContactService::save($contact);
?>
<pre><?php didItWorkInt($out); ?></pre>

<h1>Testing Add To Campaign</h1>
<?php 

$out = Infusionsoft_ContactService::addToCampaign($contact, 1);
?>
<pre><?php didItWorkBool($out); ?></pre>



<h1>Testing Add To Group</h1>
<?php 

$out = Infusionsoft_ContactService::addToGroup($contact, '1');
?>
<pre><?php didItWorkBool($out); ?></pre>

<h1>Testing Load</h1>
<?php 

$out = Infusionsoft_ContactService::load($contact->Id);

?>
<pre><?php didItWorkObject($out); ?></pre>