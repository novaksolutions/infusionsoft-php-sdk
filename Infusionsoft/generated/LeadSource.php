<?php
class Infusionsoft_Generated_LeadSource extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'Name', 'Description', 'StartDate', 'EndDate', 'CostPerLead', 'Status');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('LeadSource', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
