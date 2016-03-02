<?php
/**
 * @property String Id
 * @property String ContactId
 * @property String JobId
 * @property String DateCreated
 * @property String InvoiceTotal
 * @property String TotalPaid
 * @property String TotalDue
 * @property String PayStatus
 * @property String CreditStatus
 * @property String RefundStatus
 * @property String PayPlanStatus
 * @property String AffiliateId
 * @property String LeadAffiliateId
 * @property String PromoCode
 * @property String InvoiceType
 * @property String Description
 * @property String ProductSold
 * @property String Synced
 * @property String LastUpdated
 */
class Infusionsoft_Generated_Invoice extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'JobId', 'DateCreated', 'InvoiceTotal', 'TotalPaid', 'TotalDue', 'PayStatus', 'CreditStatus', 'RefundStatus', 'PayPlanStatus', 'AffiliateId', 'LeadAffiliateId', 'PromoCode', 'InvoiceType', 'Description', 'ProductSold', 'Synced', 'LastUpdated');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Invoice', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}

    public function fieldExists($field){
        return (array_search($field, self::$tableFields) !== false);
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
