<?php
class Infusionsoft_Generated_Company extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Address1Type', 'Address2Street1', 'Address2Street2', 'Address2Type', 'Address3Street1', 'Address3Street2', 'Address3Type', 'Anniversary', 'AssistantName', 'AssistantPhone', 'BillingInformation', 'Birthday', 'City', 'City2', 'City3', 'Company', 'AccountId', 'CompanyID', 'ContactNotes', 'ContactType', 'Country', 'Country2', 'Country3', 'CreatedBy', 'DateCreated', 'Email', 'EmailAddress2', 'EmailAddress3', 'Fax1', 'Fax1Type', 'Fax2', 'Fax2Type', 'FirstName', 'Groups', 'Id', 'JobTitle', 'LastName', 'LastUpdated', 'LastUpdatedBy', 'MiddleName', 'Nickname', 'OwnerID', 'Password', 'Phone1', 'Phone1Ext', 'Phone1Type', 'Phone2', 'Phone2Ext', 'Phone2Type', 'Phone3', 'Phone3Ext', 'Phone3Type', 'Phone4', 'Phone4Ext', 'Phone4Type', 'Phone5', 'Phone5Ext', 'Phone5Type', 'PostalCode', 'PostalCode2', 'PostalCode3', 'ReferralCode', 'SpouseName', 'State', 'State2', 'State3', 'StreetAddress1', 'StreetAddress2', 'Suffix', 'Title', 'Username', 'Validated', 'Website', 'ZipFour1', 'ZipFour2', 'ZipFour3');

    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Company', $id, $app);
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
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
