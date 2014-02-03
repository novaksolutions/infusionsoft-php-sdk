
<form>
            invoiceId: <input type="text" name="invoiceId" value="<?php if(isset($_REQUEST['invoiceId'])) echo htmlspecialchars($_REQUEST['invoiceId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::getInvoiceQuickbooksIIF($_REQUEST['invoiceId']);
	var_dump($out);
}