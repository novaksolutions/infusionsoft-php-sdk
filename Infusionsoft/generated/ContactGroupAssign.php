<?php
class Infusionsoft_Generated_ContactGroupAssign extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('GroupId', 'ContactGroup', 'DateCreated', 'ContactId', 'Contact.Address1Type', 'Contact.Address2Street1', 'Contact.Address2Street2', 'Contact.Address2Type', 'Contact.Address3Street1', 'Contact.Address3Street2', 'Contact.Address3Type', 'Contact.Anniversary', 'Contact.AssistantName', 'Contact.AssistantPhone', 'Contact.BillingInformation', 'Contact.Birthday', 'Contact.City', 'Contact.City2', 'Contact.City3', 'Contact.Company', 'Contact.CompanyID', 'Contact.ContactNotes', 'Contact.ContactType', 'Contact.Country', 'Contact.Country2', 'Contact.Country3', 'Contact.CreatedBy', 'Contact.CustomDate1', 'Contact.CustomDate2', 'Contact.CustomDate3', 'Contact.CustomDate4', 'Contact.CustomDate5', 'Contact.CustomDbl1', 'Contact.CustomDbl2', 'Contact.CustomDbl3', 'Contact.CustomDbl4', 'Contact.CustomDbl5', 'Contact.CustomField1', 'Contact.CustomField10', 'Contact.CustomField2', 'Contact.CustomField3', 'Contact.CustomField4', 'Contact.CustomField5', 'Contact.CustomField6', 'Contact.CustomField7', 'Contact.CustomField8', 'Contact.CustomField9', 'Contact.DateCreated', 'Contact.Email', 'Contact.EmailAddress2', 'Contact.EmailAddress3', 'Contact.Fax1', 'Contact.Fax1Type', 'Contact.Fax2', 'Contact.Fax2Type', 'Contact.FirstName', 'Contact.Groups', 'Contact.HTMLSignature', 'Contact.Id', 'Contact.JobTitle', 'Contact.LastName', 'Contact.LastUpdated', 'Contact.LastUpdatedBy', 'Contact.Leadsource', 'Contact.MiddleName', 'Contact.Nickname', 'Contact.OwnerID', 'Contact.Phone1', 'Contact.Phone1Ext', 'Contact.Phone1Type', 'Contact.Phone2', 'Contact.Phone2Ext', 'Contact.Phone2Type', 'Contact.Phone3', 'Contact.Phone3Ext', 'Contact.Phone3Type', 'Contact.Phone4', 'Contact.Phone4Ext', 'Contact.Phone4Type', 'Contact.Phone5', 'Contact.Phone5Ext', 'Contact.Phone5Type', 'Contact.PostalCode', 'Contact.PostalCode2', 'Contact.PostalCode3', 'Contact.ReferralCode', 'Contact.Signature', 'Contact.SpouseName', 'Contact.State', 'Contact.State2', 'Contact.State3', 'Contact.StreetAddress1', 'Contact.StreetAddress2', 'Contact.Suffix', 'Contact.Title', 'Contact.Website', 'Contact.ZipFour1', 'Contact.ZipFour2', 'Contact.ZipFour3');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ContactGroupAssign', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
