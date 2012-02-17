<?php
class Infusionsoft_Generated_User extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('City', 'Email', 'EmailAddress2', 'EmailAddress3', 'FirstName', 'HTMLSignature', 'Id', 'LastName', 'MiddleName', 'Nickname', 'Phone1', 'Phone1Ext', 'Phone1Type', 'Phone2', 'Phone2Ext', 'Phone2Type', 'PostalCode', 'Signature', 'SpouseName', 'State', 'StreetAddress1', 'StreetAddress2', 'Suffix', 'Title', 'ZipFour1');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('User', $id, $app);    	    	
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
