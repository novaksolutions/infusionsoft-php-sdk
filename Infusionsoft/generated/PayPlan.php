<?php
class Infusionsoft_Generated_PayPlan extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'InvoiceId', 'DateDue', 'AmtDue', 'Type', 'InitDate', 'StartDate', 'FirstPayAmt');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('PayPlan', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
