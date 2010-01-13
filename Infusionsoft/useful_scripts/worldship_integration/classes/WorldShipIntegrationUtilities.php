<?php
class WorldShipIntegrationUtilities{
	static function getOrdersNotMarkedAsSuccesfullyImportedYet($limit = 100){	
		return FulfillmentUtilities::getOrdersWithStatuses(array('~null~', 'EXPORTED'));	       	
	}

	static function getOrdersAwaitingImportCount(){
		return count(FulfillmentUtilities::getOrdersWithStatuses(array('EXPORTED_IMPORTED_SUCCESFULLY', 'PACKING_SLIPS_PRINTED'), array('Id')));
	}
}