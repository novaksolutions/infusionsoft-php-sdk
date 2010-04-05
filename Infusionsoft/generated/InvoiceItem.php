<?php
class Infusionsoft_Generated_InvoiceItem extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'InvoiceId', 'InvoiceAmt', 'Discount', 'DateCreated', 'Description', 'CommissionStatus');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('InvoiceItem', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
