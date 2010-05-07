<?php
class Infusionsoft_Generated_Job extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'JobTitle', 'ContactId', 'StartDate', 'DueDate', 'JobNotes', 'ProductId', 'JobStatus', 'DateCreated', 'InvoiceId', 'OrderType', 'OrderStatus', 'ShipFirstName', 'ShipMiddleName', 'ShipLastName', 'ShipCompany', 'ShipPhone', 'ShipStreet1', 'ShipStreet2', 'ShipCity', 'ShipState', 'ShipZip', 'ShipCountry');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Job', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
