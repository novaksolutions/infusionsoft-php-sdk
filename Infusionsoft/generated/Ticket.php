<?php
class Infusionsoft_Generated_Ticket extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'IssueId', 'ContactId', 'UserId', 'DevId', 'TicketTitle', 'TicketApplication', 'TicketCategory', 'TicketTypeId', 'Summary', 'Stage', 'Priority', 'Ordering', 'DateCreated', 'CreatedBy', 'LastUpdated', 'LastUpdatedBy', 'CloseDate', 'FolowUpDate', 'TargetCompletionDate', 'DateInStage', 'TimeSpent', 'HasCustomerCalled');
    
    public function __construct(){
    	$this->table = 'Ticket';
    }
}
