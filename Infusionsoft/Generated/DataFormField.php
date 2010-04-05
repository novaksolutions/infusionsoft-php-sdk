<?php
class Infusionsoft_Generated_DataFormField extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('DataType', 'Id', 'FormId', 'GroupId', 'Label', 'DefaultValue', 'Values', 'ListRows', 'UserGroup');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('DataFormField', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
