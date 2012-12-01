<?php
/**
 * @property String Id
 * @property String OpportunityId
 * @property String MoveDate
 * @property String MoveToStage
 * @property String MoveFromStage
 * @property String PrevStageMoveDate
 * @property String CreatedBy
 * @property String DateCreated
 * @property String UserId
 */
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

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
