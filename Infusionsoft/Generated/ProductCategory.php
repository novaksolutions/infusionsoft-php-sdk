<?php
class Infusionsoft_Generated_ProductCategory extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'CategoryDisplayName', 'CategoryOrder', 'ParentId');
    //Other field is CategoryImage
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductCategory', $id, $app);
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
