<?php
/**
 * @property String Id
 * @property String UserId
 * @property String GroupId
 * @property String Admin
 */
class Infusionsoft_Generated_GroupAssign extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'UserId', 'GroupId', 'Admin');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('GroupAssign', $id, $app);    	    	
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
