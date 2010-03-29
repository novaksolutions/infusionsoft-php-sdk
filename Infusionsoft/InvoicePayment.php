<?php
class Infusionsoft_InvoicePayment extends Infusionsoft_Generated_InvoicePayment{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

