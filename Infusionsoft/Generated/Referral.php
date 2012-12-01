<?php
/**
 * @property String Id
 * @property String ContactId
 * @property String AffiliateId
 * @property String DateSet
 * @property String DateExpires
 * @property String IPAddress
 * @property String Source
 * @property String Info
 * @property String Type
 */
class Infusionsoft_Generated_Referral extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'AffiliateId', 'DateSet', 'DateExpires', 'IPAddress', 'Source', 'Info', 'Type');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Referral', $id, $app);    	    	
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
