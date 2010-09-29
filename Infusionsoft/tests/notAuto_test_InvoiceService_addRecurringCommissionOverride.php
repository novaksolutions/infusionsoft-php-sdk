
<form>
            recurringinvoiceId: <input type="text" name="recurringinvoiceId" value="<?php if(isset($_REQUEST['recurringinvoiceId'])) echo $_REQUEST['recurringinvoiceId']; ?>"><br/>
            affiliateId: <input type="text" name="affiliateId" value="<?php if(isset($_REQUEST['affiliateId'])) echo $_REQUEST['affiliateId']; ?>"><br/>
            amount: <input type="text" name="amount" value="<?php if(isset($_REQUEST['amount'])) echo $_REQUEST['amount']; ?>"><br/>
            payoutType: <input type="text" name="payoutType" value="<?php if(isset($_REQUEST['payoutType'])) echo $_REQUEST['payoutType']; ?>"><br/>
            description: <input type="text" name="description" value="<?php if(isset($_REQUEST['description'])) echo $_REQUEST['description']; ?>"><br/>
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