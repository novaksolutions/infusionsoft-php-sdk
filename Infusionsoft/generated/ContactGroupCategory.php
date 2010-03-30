<?php
class Infusionsoft_Generated_ContactGroupCategory extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'CategoryName', 'CategoryDescription');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ContactGroupCategory', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
