
<form>
            invoiceId: <input type="text" name="invoiceId" value="<?php if(isset($_REQUEST['invoiceId'])) echo htmlspecialchars($_REQUEST['invoiceId']); ?>"><br/>
            autoCharge: <input type="text" name="autoCharge" value="<?php if(isset($_REQUEST['autoCharge'])) echo htmlspecialchars($_REQUEST['autoCharge']); ?>"><br/>
            creditCardId: <input type="text" name="creditCardId" value="<?php if(isset($_REQUEST['creditCardId'])) echo htmlspecialchars($_REQUEST['creditCardId']); ?>"><br/>
            merchantAccountId: <input type="text" name="merchantAccountId" value="<?php if(isset($_REQUEST['merchantAccountId'])) echo htmlspecialchars($_REQUEST['merchantAccountId']); ?>"><br/>
            daysBetweenRetry: <input type="text" name="daysBetweenRetry" value="<?php if(isset($_REQUEST['daysBetweenRetry'])) echo htmlspecialchars($_REQUEST['daysBetweenRetry']); ?>"><br/>
            maxRetry: <input type="text" name="maxRetry" value="<?php if(isset($_REQUEST['maxRetry'])) echo htmlspecialchars($_REQUEST['maxRetry']); ?>"><br/>
            initialPmtAmt: <input type="text" name="initialPmtAmt" value="<?php if(isset($_REQUEST['initialPmtAmt'])) echo htmlspecialchars($_REQUEST['initialPmtAmt']); ?>"><br/>
            initialPmtDate: <input type="text" name="initialPmtDate" value="<?php if(isset($_REQUEST['initialPmtDate'])) echo htmlspecialchars($_REQUEST['initialPmtDate']); ?>"><br/>
            planStartDate: <input type="text" name="planStartDate" value="<?php if(isset($_REQUEST['planStartDate'])) echo htmlspecialchars($_REQUEST['planStartDate']); ?>"><br/>
            numPmts: <input type="text" name="numPmts" value="<?php if(isset($_REQUEST['numPmts'])) echo htmlspecialchars($_REQUEST['numPmts']); ?>"><br/>
            daysBetweenPmts: <input type="text" name="daysBetweenPmts" value="<?php if(isset($_REQUEST['daysBetweenPmts'])) echo htmlspecialchars($_REQUEST['daysBetweenPmts']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::addPaymentPlan($_REQUEST['invoiceId'], $_REQUEST['autoCharge'], $_REQUEST['creditCardId'], $_REQUEST['merchantAccountId'], $_REQUEST['daysBetweenRetry'], $_REQUEST['maxRetry'], $_REQUEST['initialPmtAmt'], $_REQUEST['initialPmtDate'], $_REQUEST['planStartDate'], $_REQUEST['numPmts'], $_REQUEST['daysBetweenPmts']);
	var_dump($out);
}