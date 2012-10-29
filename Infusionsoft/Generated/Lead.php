<?php
class Infusionsoft_Generated_Lead extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'OpportunityTitle', 'ContactID', 'AffiliateId', 'UserID', 'StageID', 'StatusID', 'Leadsource', 'Objection', 'ProjectedRevenueLow', 'ProjectedRevenueHigh', 'OpportunityNotes', 'DateCreated', 'LastUpdated', 'LastUpdatedBy', 'CreatedBy');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Lead', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}

    public function addCustomFields($fields){
        foreach($fields as $name){
            self::addCustomField($name);
        }
	}

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
