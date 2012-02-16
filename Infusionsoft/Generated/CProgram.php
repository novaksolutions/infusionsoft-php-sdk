<?php
class Infusionsoft_Generated_CProgram extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ProgramName', 'DefaultPrice', 'DefaultCycle', 'DefaultFrequency', 'Sku', 'ShortDescription', 'BillingType', 'Description', 'HideInStore', 'Status', 'LargeImage', 'Taxable', 'Family');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('CProgram', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
	
	public function addCustomField($name){
		self::$tableFields[] = $name;
	}
}
