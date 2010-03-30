<?php
class Infusionsoft_Generated_Stage extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'StageName', 'StageOrder', 'TargetNumDays');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Stage', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
