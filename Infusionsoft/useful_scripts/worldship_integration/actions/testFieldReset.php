<?php
	set_time_limit(60 * 60);
	ini_set('memory_limit', '64M');
	
	include('../../../infusionsoft_sdk.php');
	include('../classes/WorldShipIntegrationUtilities.php');
	include('../classes/FulfillmentUtilities.php');
	
	$orders = FulfillmentUtilities::getOrdersWithStatuses('EXPORTED', array('Id'));
	FulfillmentUtilities::setOrdersShippingStatus($orders, 'TEST');
	