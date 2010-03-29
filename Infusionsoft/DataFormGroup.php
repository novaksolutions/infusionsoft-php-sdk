<?php
class Infusionsoft_DataFormGroup extends Infusionsoft_Generated_DataFormGroup{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

