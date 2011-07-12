<?php
class Infusionsoft_Generated_StageMove extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'OpportunityId', 'MoveDate', 'MoveToStage', 'MoveFromStage', 'PrevStageMoveDate', 'CreatedBy', 'DateCreated', 'UserId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('StageMove', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
