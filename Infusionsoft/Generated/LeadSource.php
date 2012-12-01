<?php
/**
 * @property String Id
 * @property String Name
 * @property String Description
 * @property String StartDate
 * @property String EndDate
 * @property String CostPerLead
 * @property String Status
 */
class Infusionsoft_Generated_LeadSource extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'Name', 'Description', 'StartDate', 'EndDate', 'CostPerLead', 'Status');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('LeadSource', $id, $app);    	    	
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
