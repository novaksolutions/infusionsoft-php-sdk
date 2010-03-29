<?php
class Infusionsoft_TicketType extends Infusionsoft_Generated_TicketType{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

