<?php
class Infusionsoft_InvoiceItem extends Infusionsoft_Generated_InvoiceItem{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

