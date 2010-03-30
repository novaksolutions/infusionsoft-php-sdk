<?php
class Infusionsoft_Generated_DataFormGroup extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'TabId', 'Name');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('DataFormGroup', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
