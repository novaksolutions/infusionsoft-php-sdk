<?php
/**
 * @property String CampaignId
 * @property String Status
 * @property String Campaign
 * @property String ContactId
 */

class Infusionsoft_Generated_Campaignee extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('CampaignId', 'Status', 'Campaign', 'ContactId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Campaignee', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
