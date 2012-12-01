<?php
/**
 * @property String Id
 * @property String FileName
 * @property String Extension
 * @property String FileSize
 * @property String ContactId
 * @property String Public
 */
class Infusionsoft_Generated_FileBox extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'FileName', 'Extension', 'FileSize', 'ContactId', 'Public');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('FileBox', $id, $app);    	    	
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
