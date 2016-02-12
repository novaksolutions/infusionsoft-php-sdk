<?php
/**
 * @property String Address1Type
 * @property String Address2Street1
 * @property String Address2Street2
 * @property String Address2Type
 * @property String Address3Street1
 * @property String Address3Street2
 * @property String Address3Type
 * @property String Anniversary
 * @property String AssistantName
 * @property String AssistantPhone
 * @property String BillingInformation
 * @property String Birthday
 * @property String City
 * @property String City2
 * @property String City3
 * @property String Company
 * @property String AccountId
 * @property String CompanyID
 * @property String ContactNotes
 * @property String ContactType
 * @property String Country
 * @property String Country2
 * @property String Country3
 * @property String CreatedBy
 * @property String DateCreated
 * @property String Email
 * @property String EmailAddress2
 * @property String EmailAddress3
 * @property String Fax1
 * @property String Fax1Type
 * @property String Fax2
 * @property String Fax2Type
 * @property String FirstName
 * @property String Groups
 * @property String Id
 * @property String JobTitle
 * @property String LastName
 * @property String LastUpdated
 * @property String LastUpdatedBy
 * @property String Leadsource
 * @property String LeadSourceId
 * @property String MiddleName
 * @property String Nickname
 * @property String OwnerID
 * @property String Password
 * @property String Phone1
 * @property String Phone1Ext
 * @property String Phone1Type
 * @property String Phone2
 * @property String Phone2Ext
 * @property String Phone2Type
 * @property String Phone3
 * @property String Phone3Ext
 * @property String Phone3Type
 * @property String Phone4
 * @property String Phone4Ext
 * @property String Phone4Type
 * @property String Phone5
 * @property String Phone5Ext
 * @property String Phone5Type
 * @property String PostalCode
 * @property String PostalCode2
 * @property String PostalCode3
 * @property String ReferralCode
 * @property String SpouseName
 * @property String State
 * @property String State2
 * @property String State3
 * @property String StreetAddress1
 * @property String StreetAddress2
 * @property String Suffix
 * @property String Title
 * @property String Username
 * @property String Validated
 * @property String Website
 * @property String ZipFour1
 * @property String ZipFour2
 * @property String ZipFour3
 */

class Infusionsoft_Generated_Contact extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Address1Type', 'Address2Street1', 'Address2Street2', 'Address2Type', 'Address3Street1', 'Address3Street2', 'Address3Type', 'Anniversary', 'AssistantName', 'AssistantPhone', 'BillingInformation', 'Birthday', 'City', 'City2', 'City3', 'Company', 'AccountId', 'CompanyID', 'ContactNotes', 'ContactType', 'Country', 'Country2', 'Country3', 'CreatedBy', 'DateCreated', 'Email', 'EmailAddress2', 'EmailAddress3', 'Fax1', 'Fax1Type', 'Fax2', 'Fax2Type', 'FirstName', 'Groups', 'Id', 'JobTitle', 'LastName', 'LastUpdated', 'LastUpdatedBy', 'Leadsource', 'LeadSourceId', 'MiddleName', 'Nickname', 'OwnerID', 'Password', 'Phone1', 'Phone1Ext', 'Phone1Type', 'Phone2', 'Phone2Ext', 'Phone2Type', 'Phone3', 'Phone3Ext', 'Phone3Type', 'Phone4', 'Phone4Ext', 'Phone4Type', 'Phone5', 'Phone5Ext', 'Phone5Type', 'PostalCode', 'PostalCode2', 'PostalCode3', 'ReferralCode', 'SpouseName', 'State', 'State2', 'State3', 'StreetAddress1', 'StreetAddress2', 'Suffix', 'Title', 'Username', 'Validated', 'Website', 'ZipFour1', 'ZipFour2', 'ZipFour3');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Contact', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}

    public function fieldExists($field){
        return (array_search($field, self::$tableFields) !== false);
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

    public function removeReadOnlyFields(){
        $readOnlyFields = array(
            'CreatedBy',
            'DateCreated',
            'Groups',
            'Id',
            'LastUpdated',
            'LastUpdatedBy',
            'Validated',
        );
        foreach ($readOnlyFields as $field){
            self::removeField($field);
        }

    }
}
