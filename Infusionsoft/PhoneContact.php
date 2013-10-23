<?php

class Infusionsoft_PhoneContact extends Infusionsoft_Generated_Base{
    protected static $tableFields = array('Id', 'LastUpdated', 'Phone1', 'Phone1Ext', 'Phone1Type', 'Phone2', 'Phone2Ext', 'Phone2Type', 'Phone3', 'Phone3Ext', 'Phone3Type', 'Phone4', 'Phone4Ext', 'Phone4Type', 'Phone5', 'Phone5Ext', 'Phone5Type');

    public function __construct($id = null, $app = null){
        parent::__construct('Contact', $id, $app);
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function fieldExists($field){
        return (array_search($field, self::$tableFields) !== false);
    }

    public function addCustomField($name){
        if (array_search($name, self::$tableFields) === false){
            self::$tableFields[] = $name;
        }

    }

    public function addCustomFields($fields){
        foreach($fields as $name){
            self::addCustomField($name);
        }
    }

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}

