
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            description: <input type="text" name="description" value="<?php if(isset($_REQUEST['description'])) echo htmlspecialchars($_REQUEST['description']); ?>"><br/>
            orderDate: <input type="text" name="orderDate" value="<?php if(isset($_REQUEST['orderDate'])) echo htmlspecialchars($_REQUEST['orderDate']); ?>"><br/>
            leadAffiliateId: <input type="text" name="leadAffiliateId" value="<?php if(isset($_REQUEST['leadAffiliateId'])) echo htmlspecialchars($_REQUEST['leadAffiliateId']); ?>"><br/>
            saleAffiliateId: <input type="text" name="saleAffiliateId" value="<?php if(isset($_REQUEST['saleAffiliateId'])) echo htmlspecialchars($_REQUEST['saleAffiliateId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::createBlankOrder($_REQUEST['contactId'], $_REQUEST['description'], $_REQUEST['orderDate'], $_REQUEST['leadAffiliateId'], $_REQUEST['saleAffiliateId']);
	var_dump($out);
}