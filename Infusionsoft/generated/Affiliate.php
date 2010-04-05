<?php
class Infusionsoft_Generated_Affiliate extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'ParentId', 'LeadAmt', 'LeadPercent', 'SaleAmt', 'SalePercent', 'PayoutType', 'DefCommissionType', 'Status', 'AffName', 'Password', 'AffCode', 'NotifyLead', 'NotifySale', 'LeadCookieFor');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Affiliate', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
