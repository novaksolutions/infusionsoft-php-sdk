
<form>
            recurringOrderId: <input type="text" name="recurringOrderId" value="<?php if(isset($_REQUEST['recurringOrderId'])) echo htmlspecialchars($_REQUEST['recurringOrderId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::createInvoiceForRecurring($_REQUEST['recurringOrderId']);
	var_dump($out);
}