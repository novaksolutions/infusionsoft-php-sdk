
<form>
            recurringinvoiceId: <input type="text" name="recurringinvoiceId" value="<?php if(isset($_REQUEST['recurringinvoiceId'])) echo htmlspecialchars($_REQUEST['recurringinvoiceId']); ?>"><br/>
            affiliateId: <input type="text" name="affiliateId" value="<?php if(isset($_REQUEST['affiliateId'])) echo htmlspecialchars($_REQUEST['affiliateId']); ?>"><br/>
            amount: <input type="text" name="amount" value="<?php if(isset($_REQUEST['amount'])) echo htmlspecialchars($_REQUEST['amount']); ?>"><br/>
            payoutType: <input type="text" name="payoutType" value="<?php if(isset($_REQUEST['payoutType'])) echo htmlspecialchars($_REQUEST['payoutType']); ?>"><br/>
            description: <input type="text" name="description" value="<?php if(isset($_REQUEST['description'])) echo htmlspecialchars($_REQUEST['description']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::addRecurringCommissionOverride($_REQUEST['recurringinvoiceId'], $_REQUEST['affiliateId'], $_REQUEST['amount'], $_REQUEST['payoutType'], $_REQUEST['description']);
	var_dump($out);
}