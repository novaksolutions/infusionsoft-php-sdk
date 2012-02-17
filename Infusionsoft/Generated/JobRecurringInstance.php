<?php
class Infusionsoft_Generated_JobRecurringInstance extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'RecurringId', 'InvoiceItemId', 'Status', 'AutoCharge', 'StartDate', 'EndDate', 'DateCreated', 'Description');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('JobRecurringInstance', $id, $app);    	    	
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
