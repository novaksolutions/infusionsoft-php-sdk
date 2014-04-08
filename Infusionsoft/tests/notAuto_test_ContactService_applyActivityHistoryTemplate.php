
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            historyId: <input type="text" name="historyId" value="<?php if(isset($_REQUEST['historyId'])) echo htmlspecialchars($_REQUEST['historyId']); ?>"><br/>
            userId: <input type="text" name="userId" value="<?php if(isset($_REQUEST['userId'])) echo htmlspecialchars($_REQUEST['userId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::applyActivityHistoryTemplate($_REQUEST['contactId'], $_REQUEST['historyId'], $_REQUEST['userId']);
	var_dump($out);
}