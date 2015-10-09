<?php
/**
 * @property String Id
 * @property String ContactId
 * @property String ParentId
 * @property String LeadAmt
 * @property String LeadPercent
 * @property String SaleAmt
 * @property String SalePercent
 * @property String PayoutType
 * @property String DefCommissionType
 * @property String Status
 * @property String AffName
 * @property String Password
 * @property String AffCode
 * @property String NotifyLead
 * @property String NotifySale
 * @property String LeadCookieFor
 */
class Infusionsoft_Generated_Affiliate extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'ParentId', 'LeadAmt', 'LeadPercent', 'SaleAmt', 'SalePercent', 'PayoutType', 'DefCommissionType', 'Status', 'AffName', 'Password', 'AffCode', 'NotifyLead', 'NotifySale', 'LeadCookieFor');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Affiliate', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		if (!in_array($name, self::$tableFields)){
            self::$tableFields[] = $name;
        }
	}

    public function addCustomFields($fields){
        foreach($fields as $name){
            self::addCustomField($name);
        }
    }

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
