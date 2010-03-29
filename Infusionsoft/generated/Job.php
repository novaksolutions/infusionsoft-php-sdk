<?php
class Infusionsoft_Generated_Job extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'JobTitle', 'ContactId', 'StartDate', 'DueDate', 'JobNotes', 'ProductId', 'JobStatus', 'DateCreated', 'InvoiceId', 'OrderType', 'OrderStatus');
    
    public function __construct(){
    	$this->table = 'Job';
    }
}
