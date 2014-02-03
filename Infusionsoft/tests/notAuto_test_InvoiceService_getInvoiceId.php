
<form>
            orderId: <input type="text" name="orderId" value="<?php if(isset($_REQUEST['orderId'])) echo htmlspecialchars($_REQUEST['orderId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::getInvoiceId($_REQUEST['orderId']);
	var_dump($out);
}