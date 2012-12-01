<?php
/**
 * @property String Id
 * @property String PayDate
 * @property String UserId
 * @property String PayAmt
 * @property String PayType
 * @property String ContactId
 * @property String PayNote
 * @property String InvoiceId
 * @property String RefundId
 * @property String ChargeId
 * @property String Commission
 * @property String Synced
 */
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

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
