<?php
class InfusionsoftOrder extends InfusionsoftData{
	public function __construct($initial_data = false){		
		parent::__construct("Job", $initial_data);		
	}
	
	public function getOrderItems($returnFields = false){		
		$DAO = new InfusionsoftOrderItemDAO();
		return $DAO->getOrderItemsForOrder($this);
	}
	
	public function getContact($returnFields){
		$DAO = new InfusionsoftContactDAO();
		return $DAO->getOneByField('Id', $this->ContactId, $returnFields);
	}
}
?>
