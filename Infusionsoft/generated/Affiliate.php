<?php
class Infusionsoft_Generated_Affiliate extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'ContactId', 'ParentId', 'LeadAmt', 'LeadPercent', 'SaleAmt', 'SalePercent', 'PayoutType', 'DefCommissionType', 'Status', 'AffName', 'Password', 'AffCode', 'NotifyLead', 'NotifySale', 'LeadCookieFor');
    
    public function __construct(){
    	$this->table = 'Affiliate';
    }
}
