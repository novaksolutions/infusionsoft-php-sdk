<?php
class Infusionsoft_Generated_UserGroup extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'Name', 'OwnerId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('UserGroup', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
