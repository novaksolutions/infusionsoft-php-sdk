<?php
/**
 * @property Integer Id
 * @property Integer IsDefault
 * @property String Label
 * @property String Name
 * @property Integer OptionIndex
 * @property Double PriceAdjustment
 * @property Integer ProductOptionId
 * @property String Sku
 */
class Infusionsoft_Generated_ProductOptionValue extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'IsDefault', 'Label', 'Name', 'OptionIndex', 'PriceAdjustment', 'ProductOptionId', 'Sku');
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductOptValue', $id, $app);
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
