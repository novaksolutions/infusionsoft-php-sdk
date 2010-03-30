<?php
class Infusionsoft_Generated_Job extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'JobTitle', 'ContactId', 'StartDate', 'DueDate', 'JobNotes', 'ProductId', 'JobStatus', 'DateCreated', 'InvoiceId', 'OrderType', 'OrderStatus');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Job', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
