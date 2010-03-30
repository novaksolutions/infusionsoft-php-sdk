<?php
class Infusionsoft_Generated_Template extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'PieceType', 'PieceTitle', 'Categories');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('Template', $id, $app);    	    	
    }
    
    public function getFields(){
		return self::$tableFields;	
	}
}