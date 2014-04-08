
<form>
            invoiceId: <input type="text" name="invoiceId" value="<?php if(isset($_REQUEST['invoiceId'])) echo htmlspecialchars($_REQUEST['invoiceId']); ?>"><br/>
            productId: <input type="text" name="productId" value="<?php if(isset($_REQUEST['productId'])) echo htmlspecialchars($_REQUEST['productId']); ?>"><br/>
            type: <input type="text" name="type" value="<?php if(isset($_REQUEST['type'])) echo htmlspecialchars($_REQUEST['type']); ?>"><br/>
            price: <input type="text" name="price" value="<?php if(isset($_REQUEST['price'])) echo htmlspecialchars($_REQUEST['price']); ?>"><br/>
            quantity: <input type="text" name="quantity" value="<?php if(isset($_REQUEST['quantity'])) echo htmlspecialchars($_REQUEST['quantity']); ?>"><br/>
            description: <input type="text" name="description" value="<?php if(isset($_REQUEST['description'])) echo htmlspecialchars($_REQUEST['description']); ?>"><br/>
            notes: <input type="text" name="notes" value="<?php if(isset($_REQUEST['notes'])) echo htmlspecialchars($_REQUEST['notes']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::addOrderItem($_REQUEST['invoiceId'], $_REQUEST['productId'], $_REQUEST['type'], $_REQUEST['price'], $_REQUEST['quantity'], $_REQUEST['description'], $_REQUEST['notes']);
	var_dump($out);
}