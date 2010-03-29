<?php
class Infusionsoft_Generated_InvoiceItem extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'InvoiceId', 'InvoiceAmt', 'Discount', 'DateCreated', 'Description', 'CommissionStatus');
    
    public function __construct(){
    	$this->table = 'InvoiceItem';
    }
}
