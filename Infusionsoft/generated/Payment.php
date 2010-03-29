<?php
class Infusionsoft_Generated_Payment extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'PayDate', 'UserId', 'PayAmt', 'PayType', 'ContactId', 'PayNote', 'InvoiceId', 'RefundId', 'ChargeId', 'Commission', 'Synced');
    
    public function __construct(){
    	$this->table = 'Payment';
    }
}
