
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            campaignStepId: <input type="text" name="campaignStepId" value="<?php if(isset($_REQUEST['campaignStepId'])) echo htmlspecialchars($_REQUEST['campaignStepId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::rescheduleCampaignStep($_REQUEST['contactId'], $_REQUEST['campaignStepId']);
	var_dump($out);
}