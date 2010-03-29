<?php
class Infusionsoft_Generated_Invoice extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'ContactId', 'DateCreated', 'InvoiceTotal', 'TotalPaid', 'TotalDue', 'PayStatus', 'CreditStatus', 'RefundStatus', 'PayPlanStatus', 'AffiliateId', 'LeadAffiliateId', 'PromoCode', 'InvoiceType', 'Description', 'ProductSold', 'Synced');
    
    public function __construct(){
    	$this->table = 'Invoice';
    }
}
