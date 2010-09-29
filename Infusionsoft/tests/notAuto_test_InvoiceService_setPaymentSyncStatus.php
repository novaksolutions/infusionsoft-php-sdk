
<form>
            id: <input type="text" name="id" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id']; ?>"><br/>
            syncStatus: <input type="text" name="syncStatus" value="<?php if(isset($_REQUEST['syncStatus'])) echo $_REQUEST['syncStatus']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::setPaymentSyncStatus($_REQUEST['id'], $_REQUEST['syncStatus']);
	var_dump($out);
}