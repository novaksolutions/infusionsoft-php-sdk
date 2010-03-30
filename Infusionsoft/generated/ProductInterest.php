<?php
class Infusionsoft_Generated_ProductInterest extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ObjectId', 'ObjType', 'ProductId', 'ProductType', 'Qty', 'DiscountPercent');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductInterest', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
