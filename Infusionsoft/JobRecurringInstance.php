<?php
class Infusionsoft_JobRecurringInstance extends Infusionsoft_Generated_JobRecurringInstance{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

