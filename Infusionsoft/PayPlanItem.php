<?php
class Infusionsoft_PayPlanItem extends Infusionsoft_Generated_PayPlanItem{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

