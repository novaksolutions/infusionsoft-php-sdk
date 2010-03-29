<?php
class Infusionsoft_Contact extends Infusionsoft_Generated_Contact{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

