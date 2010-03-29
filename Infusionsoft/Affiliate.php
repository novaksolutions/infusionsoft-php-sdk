<?php
class Infusionsoft_Affiliate extends Infusionsoft_Generated_Affiliate{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

