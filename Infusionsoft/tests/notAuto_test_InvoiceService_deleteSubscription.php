
<form>
            subscriptionId: <input type="text" name="subscriptionId" value="<?php if(isset($_REQUEST['subscriptionId'])) echo htmlspecialchars($_REQUEST['subscriptionId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::deleteSubscription($_REQUEST['subscriptionId']);
	var_dump($out);
}