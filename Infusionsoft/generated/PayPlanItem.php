<?php
class Infusionsoft_Generated_PayPlanItem extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'PayPlanId', 'DateDue', 'AmtDue', 'Status', 'AmtPaid');
    
    public function __construct(){
    	$this->table = 'PayPlanItem';
    }
}
