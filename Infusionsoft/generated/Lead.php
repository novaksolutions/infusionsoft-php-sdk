<?php
class Infusionsoft_Generated_Lead extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'OpportunityTitle', 'ContactID', 'AffiliateId', 'UserID', 'StageID', 'StatusID', 'Leadsource', 'Objection', 'ProjectedRevenueLow', 'ProjectedRevenueHigh', 'OpportunityNotes', 'DateCreated', 'LastUpdated', 'LastUpdatedBy', 'CreatedBy');
    
    public function __construct(){
    	$this->table = 'Lead';
    }
}
