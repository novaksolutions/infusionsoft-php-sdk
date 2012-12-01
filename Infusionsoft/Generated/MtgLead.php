<?php
/**
 * @property String Id
 * @property String OpportunityId
 * @property String DateAppraisalOrdered
 * @property String DateAppraisalDone
 * @property String DateAppraisalReceived
 * @property String DateTitleOrdered
 * @property String DateTitleReceived
 * @property String DateRateLocked
 * @property String DateRateLockExpires
 * @property String CreditReportDate
 * @property String ApplicationDate
 * @property String EstimatedCloseDate
 * @property String ActualCloseDate
 * @property String FundingDate
 * @property String MtgNotes
 */
class Infusionsoft_Generated_MtgLead extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'OpportunityId', 'DateAppraisalOrdered', 'DateAppraisalDone', 'DateAppraisalReceived', 'DateTitleOrdered', 'DateTitleReceived', 'DateRateLocked', 'DateRateLockExpires', 'CreditReportDate', 'ApplicationDate', 'EstimatedCloseDate', 'ActualCloseDate', 'FundingDate', 'MtgNotes');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('MtgLead', $id, $app);    	    	
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
