
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            duplicateContactId: <input type="text" name="duplicateContactId" value="<?php if(isset($_REQUEST['duplicateContactId'])) echo htmlspecialchars($_REQUEST['duplicateContactId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::merge($_REQUEST['contactId'], $_REQUEST['duplicateContactId']);
	var_dump($out);
}