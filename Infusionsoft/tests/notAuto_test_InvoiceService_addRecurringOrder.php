
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            allowDuplicate: <input type="text" name="allowDuplicate" value="<?php if(isset($_REQUEST['allowDuplicate'])) echo htmlspecialchars($_REQUEST['allowDuplicate']); ?>"><br/>
            cProgramId: <input type="text" name="cProgramId" value="<?php if(isset($_REQUEST['cProgramId'])) echo htmlspecialchars($_REQUEST['cProgramId']); ?>"><br/>
            qty: <input type="text" name="qty" value="<?php if(isset($_REQUEST['qty'])) echo htmlspecialchars($_REQUEST['qty']); ?>"><br/>
            price: <input type="text" name="price" value="<?php if(isset($_REQUEST['price'])) echo htmlspecialchars($_REQUEST['price']); ?>"><br/>
            allowTax: <input type="text" name="allowTax" value="<?php if(isset($_REQUEST['allowTax'])) echo htmlspecialchars($_REQUEST['allowTax']); ?>"><br/>
            merchantAccountId: <input type="text" name="merchantAccountId" value="<?php if(isset($_REQUEST['merchantAccountId'])) echo htmlspecialchars($_REQUEST['merchantAccountId']); ?>"><br/>
            creditCardId: <input type="text" name="creditCardId" value="<?php if(isset($_REQUEST['creditCardId'])) echo htmlspecialchars($_REQUEST['creditCardId']); ?>"><br/>
            affiliateId: <input type="text" name="affiliateId" value="<?php if(isset($_REQUEST['affiliateId'])) echo htmlspecialchars($_REQUEST['affiliateId']); ?>"><br/>
            daysTillCharge: <input type="text" name="daysTillCharge" value="<?php if(isset($_REQUEST['daysTillCharge'])) echo htmlspecialchars($_REQUEST['daysTillCharge']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::addRecurringOrder($_REQUEST['contactId'], $_REQUEST['allowDuplicate'], $_REQUEST['cProgramId'], $_REQUEST['qty'], $_REQUEST['price'], $_REQUEST['allowTax'], $_REQUEST['merchantAccountId'], $_REQUEST['creditCardId'], $_REQUEST['affiliateId'], $_REQUEST['daysTillCharge']);
	var_dump($out);
}