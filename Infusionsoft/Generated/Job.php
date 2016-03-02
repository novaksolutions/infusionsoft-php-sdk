<?php
/**
 * @property String Id
 * @property String JobTitle
 * @property String ContactId
 * @property String StartDate
 * @property String DueDate
 * @property String JobNotes
 * @property String ProductId
 * @property String JobRecurringId
 * @property String JobStatus
 * @property String DateCreated
 * @property String OrderType
 * @property String OrderStatus
 * @property String ShipFirstName
 * @property String ShipMiddleName
 * @property String ShipLastName
 * @property String ShipCompany
 * @property String ShipPhone
 * @property String ShipStreet1
 * @property String ShipStreet2
 * @property String ShipCity
 * @property String ShipState
 * @property String ShipZip
 * @property String ShipCountry
 * @property String LastUpdated
 */
class Infusionsoft_Generated_Job extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'JobTitle', 'ContactId', 'StartDate', 'DueDate', 'JobNotes', 'ProductId', 'JobRecurringId', 'JobStatus', 'DateCreated', 'OrderType', 'OrderStatus', 'ShipFirstName', 'ShipMiddleName', 'ShipLastName', 'ShipCompany', 'ShipPhone', 'ShipStreet1', 'ShipStreet2', 'ShipCity', 'ShipState', 'ShipZip', 'ShipCountry', 'LastUpdated');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Job', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		if (!in_array($name, self::$tableFields)){
            self::$tableFields[] = $name;
        }
	}

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
