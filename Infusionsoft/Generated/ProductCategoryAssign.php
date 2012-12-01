<?php
/**
 * @property String Id
 * @property String ProductId
 * @property String ProductCategoryId
 */
class Infusionsoft_Generated_ProductCategoryAssign extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'ProductId', 'ProductCategoryId');
    
    
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductCategoryAssign', $id, $app);
    }
    
    public function getFields(){
		return self::$tableFields;	
	}

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
