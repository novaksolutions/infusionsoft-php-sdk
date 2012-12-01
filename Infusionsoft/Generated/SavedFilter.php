<?php
/**
 * @property String Id
 * @property String FilterName
 * @property String ReportStoredName
 * @property String UserId
 */
class Infusionsoft_Generated_SavedFilter extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'FilterName', 'ReportStoredName', 'UserId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('SavedFilter', $id, $app);    	    	
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
