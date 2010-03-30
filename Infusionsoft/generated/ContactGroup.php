<?php
class Infusionsoft_Generated_ContactGroup extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'GroupName', 'GroupCategoryId', 'GroupDescription');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ContactGroup', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
