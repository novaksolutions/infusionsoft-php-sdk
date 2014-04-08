
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            data: <input type="text" name="data" value="<?php if(isset($_REQUEST['data'])) echo htmlspecialchars($_REQUEST['data']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::update($_REQUEST['contactId'], $_REQUEST['data']);
	var_dump($out);
}