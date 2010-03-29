<?php
class Infusionsoft_Generated_PayPlan extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'InvoiceId', 'DateDue', 'AmtDue', 'Type', 'InitDate', 'StartDate', 'FirstPayAmt');
    
    public function __construct(){
    	$this->table = 'PayPlan';
    }
}
