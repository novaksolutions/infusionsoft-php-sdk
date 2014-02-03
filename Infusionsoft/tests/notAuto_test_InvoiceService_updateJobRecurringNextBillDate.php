
<form>
            jobRecurringId: <input type="text" name="jobRecurringId" value="<?php if(isset($_REQUEST['jobRecurringId'])) echo htmlspecialchars($_REQUEST['jobRecurringId']); ?>"><br/>
            newNextBillDate: <input type="text" name="newNextBillDate" value="<?php if(isset($_REQUEST['newNextBillDate'])) echo htmlspecialchars($_REQUEST['newNextBillDate']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::updateJobRecurringNextBillDate($_REQUEST['jobRecurringId'], $_REQUEST['newNextBillDate']);
	var_dump($out);
}