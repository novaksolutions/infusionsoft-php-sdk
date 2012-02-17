<?php
class Infusionsoft_Generated_Invoice extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'JobId', 'DateCreated', 'InvoiceTotal', 'TotalPaid', 'TotalDue', 'PayStatus', 'CreditStatus', 'RefundStatus', 'PayPlanStatus', 'AffiliateId', 'LeadAffiliateId', 'PromoCode', 'InvoiceType', 'Description', 'ProductSold', 'Synced');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Invoice', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
