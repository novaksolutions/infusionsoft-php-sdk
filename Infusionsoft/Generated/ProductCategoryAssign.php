<?php
class Infusionsoft_Generated_ProductCategoryAssign extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ProductId', 'ProductCategoryId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductCategoryAssign', $id, $app);
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
