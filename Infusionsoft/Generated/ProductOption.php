<?php
/**
 * @property Integer Id
 * @property Integer ProductId
 * @property Integer AllowSpaces
 * @property String CanContain
 * @property Integer CanEndWith
 * @property String CanStartWith
 * @property Integer IsRequired
 * @property String Label
 * @property Integer MaxChars
 * @property Integer MinChars
 * @property String Name
 * @property String OptionType
 * @property Integer Order
 * @property String TextMessage
 */
class Infusionsoft_Generated_ProductOption extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ProductId', 'AllowSpaces', 'CanContain', 'CanEndWith', 'CanStartWith', 'IsRequired', 'Label', 'MaxChars', 'MinChars', 'Name', 'OptionType', 'Order', 'TextMessage');
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductOption', $id, $app);
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
