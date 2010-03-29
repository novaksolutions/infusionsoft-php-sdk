<?php
class Infusionsoft_Generated_ContactAction extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'ContactId', 'OpportunityId', 'ActionType', 'ActionDescription', 'CreationDate', 'CreationNotes', 'CompletionDate', 'ActionDate', 'EndDate', 'PopupDate', 'UserID', 'Accepted', 'CreatedBy', 'Priority', 'IsAppointment');
    
    public function __construct(){
    	$this->table = 'ContactAction';
    }
}
