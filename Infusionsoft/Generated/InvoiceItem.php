<?php
/**
 * @property String Id
 * @property String InvoiceId
 * @property String OrderItemId
 * @property String InvoiceAmt
 * @property String Discount
 * @property String DateCreated
 * @property String Description
 * @property String CommissionStatus
 */
class Infusionsoft_Generated_InvoiceItem extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'InvoiceId', 'OrderItemId', 'InvoiceAmt', 'Discount', 'DateCreated', 'Description', 'CommissionStatus');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('InvoiceItem', $id, $app);    	    	
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
