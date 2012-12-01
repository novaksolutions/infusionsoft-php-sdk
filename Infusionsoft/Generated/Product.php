<?php
/**
 * @property String Id
 * @property String ProductName
 * @property String ProductPrice
 * @property String Sku
 * @property String ShortDescription
 * @property String Taxable
 * @property String Weight
 * @property String IsPackage
 * @property String NeedsDigitalDelivery
 * @property String Description
 * @property String HideInStore
 * @property String Status
 * @property String TopHTML
 * @property String BottomHTML
 * @property String ShippingTime
 * @property String InventoryNotifiee
 * @property String InventoryLimit
 */
class Infusionsoft_Generated_Product extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ProductName', 'ProductPrice', 'Sku', 'ShortDescription', 'Taxable', 'Weight', 'IsPackage', 'NeedsDigitalDelivery', 'Description', 'HideInStore', 'Status', 'TopHTML', 'BottomHTML', 'ShippingTime', 'InventoryNotifiee', 'InventoryLimit', 'Shippable');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Product', $id, $app);    	    	
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
