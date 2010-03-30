<?php
class Infusionsoft_Generated_Status extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'StatusName', 'StatusOrder', 'TargetNumDays');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Status', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
