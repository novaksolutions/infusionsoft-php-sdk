<?php
class FulfillmentUtilities{
	public static function setOrdersShippingStatus($orders, $status){
    	foreach($orders as $order){
    		$order->_ShippingStatus = $status;    		
    		$order->save();
    	}
    }
    
    public static function getOrdersForPackingSlips(){
    	return FulfillmentUtilities::getOrdersWithStatuses(array('~null~', 'EXPORTED', 'EXPORTED_IMPORTED_SUCCESFULLY'));	
    }
    
    public static function getOrdersWithStatuses($statuses, $customReturnFields = false){
    	$orderDAO = new InfusionsoftOrderDAO();
    	$returnFields = array('Id', 'InvoiceId', 'ContactId', 'DateCreated', 'OrderStatus', 'JobStatus', 'JobNotes');
    	
    	if($customReturnFields !== false){
    		$returnFields = $customReturnFields;
    	}
    	    	
    	//If they just passed in a single value, convert it to an array...
    	if(!is_array($statuses)) $statuses = array($statuses);
    	
    	$ordersToReturn = array();    	
    	foreach($statuses as $status){
    		$fetchedOrders = $orderDAO->getByField('_ShippingStatus', $status, $returnFields); 
			$ordersToReturn = array_merge($fetchedOrders, $ordersToReturn); 			   		
    	} 
		return $ordersToReturn;    	
    }
}