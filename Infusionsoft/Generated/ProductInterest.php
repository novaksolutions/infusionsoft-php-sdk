<?php
/**
 * @property String Id
 * @property String ObjectId
 * @property String ObjType
 * @property String ProductId
 * @property String ProductType
 * @property String Qty
 * @property String DiscountPercent
 */
class Infusionsoft_Generated_ProductInterest extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ObjectId', 'ObjType', 'ProductId', 'ProductType', 'Qty', 'DiscountPercent');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductInterest', $id, $app);    	    	
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
