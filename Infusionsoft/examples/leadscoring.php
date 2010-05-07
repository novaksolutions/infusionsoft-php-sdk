<form>
	ContactId: <input type="text" name="ContactId" value="<?php if(isset($_REQUEST['ContactId'])) echo $_REQUEST['ContactId']; ?>" />
	<input type="submit"/>
</form><br/>
<?php
include('../infusionsoft.php');
if(isset($_REQUEST['ContactId'])){
	Infusionsoft_Contact::addCustomField('_LeadScore');
	
	$contact = new Infusionsoft_Contact($_REQUEST['ContactId']);
	$contact->_LeadScore = $contact->_LeadScore + 1;
	$contact->save();
	
	echo 'Lead Score for Contact: ' . $contact->FirstName . ' ' . $contact->LastName . ' is now: ' . $contact->_LeadScore;
} 

