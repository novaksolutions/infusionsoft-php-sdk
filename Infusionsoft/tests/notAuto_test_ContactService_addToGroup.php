
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            groupId: <input type="text" name="groupId" value="<?php if(isset($_REQUEST['groupId'])) echo htmlspecialchars($_REQUEST['groupId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::addToGroup($_REQUEST['contactId'], $_REQUEST['groupId']);
	var_dump($out);
}