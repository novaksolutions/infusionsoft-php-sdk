<?php
class Infusionsoft_Generated_Product extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ProductName', 'ProductPrice', 'Sku', 'ShortDescription', 'Taxable', 'Weight', 'IsPackage', 'NeedsDigitalDelivery', 'Description', 'HideInStore', 'Status', 'TopHTML', 'BottomHTML', 'ShippingTime', 'InventoryNotifiee', 'InventoryLimit');
    
    
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
