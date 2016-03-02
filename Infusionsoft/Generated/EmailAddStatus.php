<?php
/**
 * @property String Id
 * @property String DateCreated
 * @property String Email
 * @property String LastClickDate
 * @property String LastOpenDate
 * @property String LastSentDate
 * @property String Type
 */

class Infusionsoft_Generated_EmailAddStatus extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'DateCreated', 'Email', 'LastClickDate','LastOpenDate','LastSentDate','Type');
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('EmailAddStatus', $id, $app);
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}
