<?php
class Infusionsoft_Generated_JobRecurringInstance extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'RecurringId', 'InvoiceItemId', 'Status', 'AutoCharge', 'StartDate', 'EndDate', 'DateCreated', 'Description');
    
    public function __construct(){
    	$this->table = 'JobRecurringInstance';
    }
}
