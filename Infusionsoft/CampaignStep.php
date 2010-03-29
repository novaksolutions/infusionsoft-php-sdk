<?php
class Infusionsoft_CampaignStep extends Infusionsoft_Generated_CampaignStep{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

