<?php
class Infusionsoft_DataFormField extends Infusionsoft_Generated_DataFormField{


    public function __construct($id = null, $app = null){
    	parent::__construct($id, $app);    	    	
    }

    public function getValues(){
        $out = array();
        if($this->DataType == Infusionsoft_CustomFieldService::$DataType_Dropdown){
            $out = explode("\n", $this->Values);
            $out = array_filter($out, "Infusionsoft_DataFormField_isEmpty");
        } else {
            throw new Infusionsoft_Exception($this->Label . ' is not a drop down custom field.');
        }
        return $out;
    }

    public function setValues(array $customFieldValues){
        if($this->DataType == Infusionsoft_CustomFieldService::$DataType_Dropdown){
            $this->Values = "\n" . implode("\n", $customFieldValues);
        } else {
            throw new Infusionsoft_Exception($this->Label . ' is not a drop down custom field.');
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

function Infusionsoft_DataFormField_isEmpty($var){
    return !trim($var) == '';
}

