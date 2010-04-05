<?php
class Infusionsoft_Generated_ContactAction extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'OpportunityId', 'ActionType', 'ActionDescription', 'CreationDate', 'CreationNotes', 'CompletionDate', 'ActionDate', 'EndDate', 'PopupDate', 'UserID', 'Accepted', 'CreatedBy', 'Priority', 'IsAppointment');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ContactAction', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
