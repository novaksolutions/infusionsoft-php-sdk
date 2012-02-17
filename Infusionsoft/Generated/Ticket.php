<?php
class Infusionsoft_Generated_Ticket extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'IssueId', 'ContactId', 'UserId', 'DevId', 'TicketTitle', 'TicketApplication', 'TicketCategory', 'TicketTypeId', 'Summary', 'Stage', 'Priority', 'Ordering', 'DateCreated', 'CreatedBy', 'LastUpdated', 'LastUpdatedBy', 'CloseDate', 'FolowUpDate', 'TargetCompletionDate', 'DateInStage', 'TimeSpent', 'HasCustomerCalled');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Ticket', $id, $app);    	    	
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
