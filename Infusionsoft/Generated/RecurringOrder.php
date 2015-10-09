<?php
/**
 * @property String Id
 * @property String ContactId
 * @property String OriginatingOrderId
 * @property String ProgramId
 * @property String SubscriptionPlanId
 * @property String ProductId
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
 * @property String Qty
 */
class Infusionsoft_Generated_RecurringOrder extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'OriginatingOrderId', 'ProgramId', 'SubscriptionPlanId', 'ProductId', 'StartDate', 'EndDate', 'LastBillDate', 'NextBillDate', 'PaidThruDate', 'BillingCycle', 'Frequency', 'BillingAmt', 'Status', 'ReasonStopped', 'AutoCharge', 'CC1', 'CC2', 'NumDaysBetweenRetry', 'MaxRetry', 'MerchantAccountId', 'AffiliateId', 'PromoCode', 'LeadAffiliateId', 'Qty');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('RecurringOrder', $id, $app);    	    	
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
}
