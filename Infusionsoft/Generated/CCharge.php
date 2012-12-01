<?php
/**
 * @property String Id
 * @property String RefNum
 * @property String ApprCode
 * @property String Amt
 * @property String CCId
 */
class Infusionsoft_Generated_CCharge extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'RefNum', 'ApprCode', 'Amt', 'CCId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('CCharge', $id, $app);    	    	
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
