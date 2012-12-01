<?php
/**
 * @property String Id
 * @property String CategoryDisplayName
 * @property String CategoryOrder
 * @property String ParentId
 */
class Infusionsoft_Generated_ProductCategory extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'CategoryDisplayName', 'CategoryOrder', 'ParentId');
    //Other field is CategoryImage
    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('ProductCategory', $id, $app);
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
