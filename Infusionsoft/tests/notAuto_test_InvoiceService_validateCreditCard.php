
<form>
            creditCard: <input type="text" name="creditCard" value="<?php if(isset($_REQUEST['creditCard'])) echo htmlspecialchars($_REQUEST['creditCard']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::validateCreditCard($_REQUEST['creditCard']);
	var_dump($out);
}