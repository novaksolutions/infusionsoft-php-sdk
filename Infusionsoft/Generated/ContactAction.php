<?php
/**
 * @property String Id
 * @property String ContactId
 * @property String OpportunityId
 * @property String ObjectType
 * @property String ActionType
 * @property String ActionDescription
 * @property String CreationDate
 * @property String CreationNotes
 * @property String CompletionDate
 * @property String ActionDate
 * @property String EndDate
 * @property String PopupDate
 * @property String UserID
 * @property String Accepted
 * @property String CreatedBy
 * @property String LastUpdated
 * @property String LastUpdatedBy
 * @property String Priority
 * @property String IsAppointment
 */
class Infusionsoft_Generated_ContactAction extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'OpportunityId', 'ObjectType', 'ActionType', 'ActionDescription', 'CreationDate', 'CreationNotes', 'CompletionDate', 'ActionDate', 'EndDate', 'PopupDate', 'UserID', 'Accepted', 'CreatedBy', 'LastUpdated', 'LastUpdatedBy', 'Priority', 'IsAppointment');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ContactAction', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		if (!in_array($name, self::$tableFields)){
            self::$tableFields[] = $name;
        }
	}


    public function addCustomFields($fields){
        foreach($fields as $name){
            self::addCustomField($name);
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
