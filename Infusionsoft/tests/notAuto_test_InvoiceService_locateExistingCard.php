
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            last4: <input type="text" name="last4" value="<?php if(isset($_REQUEST['last4'])) echo htmlspecialchars($_REQUEST['last4']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::locateExistingCard($_REQUEST['contactId'], $_REQUEST['last4']);
	var_dump($out);
}