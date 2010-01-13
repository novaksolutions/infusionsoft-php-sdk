<?php
	set_time_limit(60 * 60);
	ini_set('memory_limit', '64M');
	
	include('../../../infusionsoft_sdk.php');
	include('../classes/WorldShipIntegrationUtilities.php');
	
	$orders = WorldShipIntegrationUtilities::getOrdersNotMarkedAsSuccesfullyImportedYet(50);
	FulfillmentUtilities::setOrdersShippingStatus($orders, "EXPORTED_IMPORTED_SUCCESFULLY");
?>
<html>
	<body>
		<?php echo count($orders); ?> Orders Marked As Succesfully Imported Into Worldship.
	</body>
</html>