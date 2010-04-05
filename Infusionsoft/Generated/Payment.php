<?php
class Infusionsoft_Generated_Payment extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'PayDate', 'UserId', 'PayAmt', 'PayType', 'ContactId', 'PayNote', 'InvoiceId', 'RefundId', 'ChargeId', 'Commission', 'Synced');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Payment', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
