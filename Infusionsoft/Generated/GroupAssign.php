<?php
class Infusionsoft_Generated_GroupAssign extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'UserId', 'GroupId', 'Admin');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('GroupAssign', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
