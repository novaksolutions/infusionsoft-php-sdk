<?php
class Infusionsoft_ProductInterestBundle extends Infusionsoft_Generated_ProductInterestBundle{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

