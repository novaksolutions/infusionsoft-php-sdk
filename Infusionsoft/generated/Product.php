<?php
class Infusionsoft_Generated_Product extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ProductName', 'ProductPrice', 'Sku', 'ShortDescription', 'Taxable', 'Weight', 'IsPackage', 'NeedsDigitalDelivery', 'SubCategory', 'Description', 'HideInStore', 'Status', 'TopHTML', 'BottomHTML', 'ShippingTime', 'LargeImage', 'InventoryNotifiee', 'InventoryLimit');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Product', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
