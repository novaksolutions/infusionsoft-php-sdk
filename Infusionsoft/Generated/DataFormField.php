<?php
/**
 * @property String DataType
 * @property String Id
 * @property String FormId
 * @property String GroupId
 * @property String Name
 * @property String Label
 * @property String DefaultValue
 * @property String Values
 * @property String ListRows
 */
class Infusionsoft_Generated_DataFormField extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('DataType', 'Id', 'FormId', 'GroupId', 'Name', 'Label', 'DefaultValue', 'Values', 'ListRows');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('DataFormField', $id, $app);    	    	
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
