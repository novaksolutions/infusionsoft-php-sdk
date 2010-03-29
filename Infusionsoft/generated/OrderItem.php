<?php
class Infusionsoft_Generated_OrderItem extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'OrderId', 'ProductId', 'ItemName', 'Qty', 'CPU', 'PPU', 'ItemDescription', 'InvoiceItemId', 'ItemType');
    
    public function __construct(){
    	$this->table = 'OrderItem';
    }
}
