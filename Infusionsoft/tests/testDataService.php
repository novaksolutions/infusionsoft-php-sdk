<?php
include('../infusionsoft.php');
include('testUtils.php');
?>
<h1>Testing Add</h1>
<?php 
$contact = new Infusionsoft_Contact();
$contact->FirstName = 'Joey';
$out = $contact->save();
?>
<pre><?php didItWorkInt($out); ?></pre>

<h1>Testing Update</h1>
<?php 
$contact->LastName = 'Novak';
$out = $contact->save();
?>
<pre><?php didItWorkInt($out); ?></pre>



<h1>Testing Loading of an object by FirstName (findByField)</h1><?php
$out = Infusionsoft_DataService::findByField(new Infusionsoft_Contact(), 'FirstName', 'Joey', 1, 0);
?>
<pre><?php didItWorkNonEmptyArray($out); ?></pre>

<h1>Testing Loading of an object by Id (load)</h1><?php
$out = Infusionsoft_DataService::load(new Infusionsoft_Contact(), $contact->Id);
?>
<pre><?php didItWorkObject($out); ?></pre>

<h1>Testing Loading of an object by Id Using Query</h1><?php
$out = Infusionsoft_DataService::query(new Infusionsoft_Contact(), array('Id'=>$contact->Id));
?>
<pre><?php didItWorkNonEmptyArray($out); ?></pre>

<h1>Testing Loading of an object by Id Using Query With Order By</h1><?php
$out = Infusionsoft_DataService::queryWithOrderBy(new Infusionsoft_Contact(), array('Id'=>$contact->Id), "FirstName", true);
?>
<pre><?php didItWorkNonEmptyArray($out); ?></pre>


<h1>Testing Delete</h1>
<?php 
	$out = $contact->delete();	
?>
<pre>
It Worked!
</pre>

<h1>Testing GetAppSetting</h1>
<pre>
<?php
	$out = Infusionsoft_DataService::getAppSetting('Product', 'trackcpu');
	echo didItWorkNotEmpty($out); 
?>
</pre>

<h1>Testing addCustomField</h1>
<pre>
No Test Written Yet
</pre>

<h1>Testing updateCustomField</h1>
<pre>
No Test Written Yet
</pre>

<h1>Testing getAppointmentICal</h1>
<pre>
No Test Written Yet
</pre>

<h1>Testing getAllCustomFields</h1>

<pre>
    <?=print_r(Infusionsoft_DataService::getCustomFields(new Infusionsoft_Contact()), true)?>
</pre>