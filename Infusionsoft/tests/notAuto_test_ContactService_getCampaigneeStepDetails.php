
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            stepId: <input type="text" name="stepId" value="<?php if(isset($_REQUEST['stepId'])) echo htmlspecialchars($_REQUEST['stepId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::getCampaigneeStepDetails($_REQUEST['contactId'], $_REQUEST['stepId']);
	var_dump($out);
}