<?php
/**
 * @property String Id
 * @property String InvoiceId
 * @property String DateDue
 * @property String AmtDue
 * @property String Type
 * @property String InitDate
 * @property String StartDate
 * @property String FirstPayAmt
 */
class Infusionsoft_Generated_PayPlan extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'InvoiceId', 'DateDue', 'AmtDue', 'Type', 'InitDate', 'StartDate', 'FirstPayAmt');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('PayPlan', $id, $app);    	    	
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
