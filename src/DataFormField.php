<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String DataType
 * @property String Id
 * @property String FormId
 * @property String GroupId
 * @property String Name
 * @property String Label
 * @property String DefaultValue
 * @property String Values
 * @property String ListRows
 */
class DataFormField extends Base{
    protected static $tableFields = array('DataType', 'Id', 'FormId', 'GroupId', 'Name', 'Label', 'DefaultValue', 'Values', 'ListRows');

    public function __construct($id = null, $app = null){
        parent::__construct('DataFormField', $id, $app);
    }

    public function getValues(){
        $out = array();
        if($this->canHaveCustomValues()){
            $out = explode("\n", $this->Values);
            $out = array_filter($out, "DataFormField_isEmpty");
        } else {
            throw new Exception($this->Label . ' cannot have values.');
        }
        return $out;
    }

    public function canHaveCustomValues()
    {
        return in_array($this->DataType, array(
            CustomFieldService::$DataType_Dropdown,
            CustomFieldService::$DataType_List
            )
        );
    }

    public function setValues(array $customFieldValues){
        if($this->DataType == CustomFieldService::$DataType_Dropdown){
            $this->Values = "\n" . implode("\n", $customFieldValues);
        } else {
            throw new Exception($this->Label . ' cannot have values.');
        }

    }

    public function addValue($value){
        $values = $this->getCustomFieldValues();
        $values[] = $value;
        $this->setCustomFieldValues($values);
    }

    public function removeValue($value){
        $success = false;

        $values = $this->getCustomFieldValues();
        $valueIndex = array_search($value, $values);
        if($valueIndex !== false){
            unset($value[$valueIndex]);
            $this->setCustomFieldValues($values);
            $success = true;
        }
        return $success;
    }
}

function DataFormField_isEmpty($var){
    return !trim($var) == '';
}

