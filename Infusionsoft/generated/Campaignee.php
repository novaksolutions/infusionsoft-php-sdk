<?php
class Infusionsoft_Generated_Campaignee extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('CampaignId', 'Status', 'Campaign', 'ContactId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Campaignee', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
