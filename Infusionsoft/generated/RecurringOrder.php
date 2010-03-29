<?php
class Infusionsoft_Generated_RecurringOrder extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'ContactId', 'ProgramId', 'StartDate', 'EndDate', 'LastBillDate', 'NextBillDate', 'PaidThruDate', 'BillingCycle', 'Frequency', 'BillingAmt', 'Status', 'ReasonStopped', 'AutoCharge', 'CC1', 'CC2', 'NumDaysBetweenRetry', 'MaxRetry', 'MerchantAccountId', 'AffiliateId', 'PromoCode', 'LeadAffiliateId');
    
    public function __construct(){
    	$this->table = 'RecurringOrder';
    }
}
