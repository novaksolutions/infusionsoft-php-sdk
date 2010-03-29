<?php
class Infusionsoft_Ticket extends Infusionsoft_Generated_Ticket{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

