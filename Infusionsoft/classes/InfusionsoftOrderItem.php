<?php
class InfusionsoftOrderItem extends InfusionsoftData{
	public function __construct($initial_data = false){		
		parent::__construct("OrderItem", $initial_data);		
	}

	public function getProduct($returnFields = false){
		$productDAO = new InfusionsoftProductDAO();
		return $productDAO->getOneByField('Id', $this->ProductId);			
	}
}
?>