
<form>
            stepId: <input type="text" name="stepId" value="<?php if(isset($_REQUEST['stepId'])) echo htmlspecialchars($_REQUEST['stepId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::getCampaignStepDetails($_REQUEST['stepId']);
	var_dump($out);
}