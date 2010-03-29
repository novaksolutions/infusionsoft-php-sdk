<?php
class Infusionsoft_Campaignee extends Infusionsoft_Generated_Campaignee{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

