<?php
/**
 * @property String Id
 * @property String GroupName
 * @property String GroupCategoryId
 * @property String GroupDescription
 */
class Infusionsoft_Generated_ContactGroup extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'GroupName', 'GroupCategoryId', 'GroupDescription');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ContactGroup', $id, $app);    	    	
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
