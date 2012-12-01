<?php
/**
 * @property String Id
 * @property String OrderId
 * @property String ProductId
 * @property String SubscriptionPlanId
 * @property String ItemName
 * @property String Qty
 * @property String CPU
 * @property String PPU
 * @property String ItemDescription
 * @property String ItemType
 * @property String Notes
 */
class Infusionsoft_Generated_OrderItem extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'OrderId', 'ProductId', 'SubscriptionPlanId', 'ItemName', 'Qty', 'CPU', 'PPU', 'ItemDescription', 'ItemType', 'Notes');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('OrderItem', $id, $app);    	    	
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
