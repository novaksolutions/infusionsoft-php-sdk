<?php
/**
 * @property String RecurringOrderId
 * @property String ContactId
 * @property String SubscriptionPlanId
 * @property String ProgramId
 * @property String StartDate
 * @property String EndDate
 * @property String LastBillDate
 * @property String NextBillDate
 * @property String PaidThruDate
 * @property String BillingCycle
 * @property String Frequency
 * @property String BillingAmt
 * @property String Status
 * @property String ReasonStopped
 * @property String AutoCharge
 * @property String CC1
 * @property String CC2
 * @property String NumDaysBetweenRetry
 * @property String MaxRetry
 * @property String MerchantAccountId
 * @property String AffiliateId
 * @property String PromoCode
 * @property String LeadAffiliateId
 * @property String City
 * @property String Email
 * @property String EmailAddress2
 * @property String EmailAddress3
 * @property String FirstName
 * @property String HTMLSignature
 * @property String LastName
 * @property String MiddleName
 * @property String Nickname
 * @property String Phone1
 * @property String Phone1Ext
 * @property String Phone1Type
 * @property String Phone2
 * @property String Phone2Ext
 * @property String Phone2Type
 * @property String PostalCode
 * @property String Signature
 * @property String SpouseName
 * @property String State
 * @property String StreetAddress1
 * @property String StreetAddress2
 * @property String Suffix
 * @property String Title
 * @property String ZipFour1
 */
class Infusionsoft_Generated_RecurringOrderWithContact extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('RecurringOrderId', 'ContactId', 'SubscriptionPlanId', 'ProgramId', 'StartDate', 'EndDate', 'LastBillDate', 'NextBillDate', 'PaidThruDate', 'BillingCycle', 'Frequency', 'BillingAmt', 'Status', 'ReasonStopped', 'AutoCharge', 'CC1', 'CC2', 'NumDaysBetweenRetry', 'MaxRetry', 'MerchantAccountId', 'AffiliateId', 'PromoCode', 'LeadAffiliateId', 'City', 'Email', 'EmailAddress2', 'EmailAddress3', 'FirstName', 'HTMLSignature', 'LastName', 'MiddleName', 'Nickname', 'Phone1', 'Phone1Ext', 'Phone1Type', 'Phone2', 'Phone2Ext', 'Phone2Type', 'PostalCode', 'Signature', 'SpouseName', 'State', 'StreetAddress1', 'StreetAddress2', 'Suffix', 'Title', 'ZipFour1');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('RecurringOrderWithContact', $id, $app);    	    	
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
