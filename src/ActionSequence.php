<?php
namespace NovakSolutions\Infusionsoft;

/**
 * @property String Id
 * @property String TemplateName
 * @property String VisibleToTheseUsers
 */

class ActionSequence extends Base{
    public function __construct($id = null, $app = null){
        parent::__construct('ActionSequence', $id, $app);
    }

    protected static $tableFields = array('Id', 'TemplateName', 'VisibleToTheseUsers');



    public function getFields(){
        return self::$tableFields;
    }

    public function addCustomField($name){
        self::$tableFields[] = $name;
    }

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}



