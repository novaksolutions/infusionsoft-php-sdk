<?php
class Infusionsoft_Generated_OrderItem extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'OrderId', 'ProductId', 'ItemName', 'Qty', 'CPU', 'PPU', 'ItemDescription', 'InvoiceItemId', 'ItemType');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('OrderItem', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
