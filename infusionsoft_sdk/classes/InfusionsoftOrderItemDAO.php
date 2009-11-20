<?php
class InfusionsoftOrderItemDAO extends InfusionsoftDataDAO {
	public function __construct(){
		parent::__construct('OrderItem');
	}
	
	public function getOrderItemsForOrder($order, $returnFields = false){
		return $this->getByField('OrderId', $order->Id, $returnFields);	
	}
}