<?php
	set_time_limit(60 * 60);
	ini_set('memory_limit', '64M');
	
	include('../../../infusionsoft_sdk.php');
	include('../classes/WorldShipIntegrationUtilities.php');
	include('../classes/FulfillmentUtilities.php');
	
	$orders = FulfillmentUtilities::getOrdersWithStatuses(array('EXPORTED', 'EXPORTED_IMPORTED_SUCCESFULLY'));
	FulfillmentUtilities::setOrdersShippingStatus($orders, "PACKING_SLIPS_PRINTED");
?>
<html>
	<body>
		<?php echo count($orders); ?> Orders Marked As Succesfully Printed.
	</body>
</html>