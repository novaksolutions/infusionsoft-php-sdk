<?php
/**
 * @property String Id
 * @property String PayPlanId
 * @property String DateDue
 * @property String AmtDue
 * @property String Status
 * @property String AmtPaid
 */
class Infusionsoft_Generated_PayPlanItem extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'PayPlanId', 'DateDue', 'AmtDue', 'Status', 'AmtPaid');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('PayPlanItem', $id, $app);    	    	
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
