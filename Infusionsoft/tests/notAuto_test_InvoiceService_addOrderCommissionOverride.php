
<form>
            invoiceId: <input type="text" name="invoiceId" value="<?php if(isset($_REQUEST['invoiceId'])) echo htmlspecialchars($_REQUEST['invoiceId']); ?>"><br/>
            affiliateId: <input type="text" name="affiliateId" value="<?php if(isset($_REQUEST['affiliateId'])) echo htmlspecialchars($_REQUEST['affiliateId']); ?>"><br/>
            productId: <input type="text" name="productId" value="<?php if(isset($_REQUEST['productId'])) echo htmlspecialchars($_REQUEST['productId']); ?>"><br/>
            percentage: <input type="text" name="percentage" value="<?php if(isset($_REQUEST['percentage'])) echo htmlspecialchars($_REQUEST['percentage']); ?>"><br/>
            amount: <input type="text" name="amount" value="<?php if(isset($_REQUEST['amount'])) echo htmlspecialchars($_REQUEST['amount']); ?>"><br/>
            payoutType: <input type="text" name="payoutType" value="<?php if(isset($_REQUEST['payoutType'])) echo htmlspecialchars($_REQUEST['payoutType']); ?>"><br/>
            description: <input type="text" name="description" value="<?php if(isset($_REQUEST['description'])) echo htmlspecialchars($_REQUEST['description']); ?>"><br/>
            date: <input type="text" name="date" value="<?php if(isset($_REQUEST['date'])) echo htmlspecialchars($_REQUEST['date']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::addOrderCommissionOverride($_REQUEST['invoiceId'], $_REQUEST['affiliateId'], $_REQUEST['productId'], $_REQUEST['percentage'], $_REQUEST['amount'], $_REQUEST['payoutType'], $_REQUEST['description'], $_REQUEST['date']);
	var_dump($out);
}