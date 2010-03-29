<?php
class Infusionsoft_RecurringOrder extends Infusionsoft_Generated_RecurringOrder{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

