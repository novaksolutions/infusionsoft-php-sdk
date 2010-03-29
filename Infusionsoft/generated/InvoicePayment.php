<?php
class Infusionsoft_Generated_InvoicePayment extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'InvoiceId', 'Amt', 'PayDate', 'PayStatus', 'SkipCommission');
    
    public function __construct(){
    	$this->table = 'InvoicePayment';
    }
}
