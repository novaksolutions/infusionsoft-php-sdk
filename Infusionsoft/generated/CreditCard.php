<?php
class Infusionsoft_Generated_CreditCard extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ContactId', 'BillName', 'FirstName', 'LastName', 'PhoneNumber', 'Email', 'BillAddress1', 'BillAddress2', 'BillCity', 'BillState', 'BillZip', 'BillCountry', 'ShipFirstName', 'ShipMiddleName', 'ShipLastName', 'ShipCompanyName', 'ShipPhoneNumber', 'ShipAddress1', 'ShipAddress2', 'ShipCity', 'ShipState', 'ShipZip', 'ShipCountry', 'ShipName', 'NameOnCard', 'CardNumber', 'Last4', 'ExpirationMonth', 'ExpirationYear', 'CVV2', 'Status', 'CardType', 'StartDateMonth', 'StartDateYear', 'MaestroIssueNumber');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('CreditCard', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
