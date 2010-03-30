<?php
class Infusionsoft_Generated_Lead extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'OpportunityTitle', 'ContactID', 'AffiliateId', 'UserID', 'StageID', 'StatusID', 'Leadsource', 'Objection', 'ProjectedRevenueLow', 'ProjectedRevenueHigh', 'OpportunityNotes', 'DateCreated', 'LastUpdated', 'LastUpdatedBy', 'CreatedBy');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Lead', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
