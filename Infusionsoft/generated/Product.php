<?php
class Infusionsoft_Generated_Product extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'ProductName', 'ProductPrice', 'Sku', 'ShortDescription', 'Taxable', 'Weight', 'IsPackage', 'NeedsDigitalDelivery', 'SubCategory', 'Description', 'HideInStore', 'Status', 'TopHTML', 'BottomHTML', 'ShippingTime', 'LargeImage', 'InventoryNotifiee', 'InventoryLimit');
    
    public function __construct(){
    	$this->table = 'Product';
    }
}
