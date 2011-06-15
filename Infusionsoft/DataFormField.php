<?php
class Infusionsoft_DataFormField extends Infusionsoft_Generated_DataFormField{


    public function __construct($id = null, $app = null){
    	parent::__construct($id, $app);    	    	
    }

    public function getCustomFieldValues(){
        $out = array();
        if($this->DataType == Infusionsoft_CustomFieldService::$DataType_Dropdown){
            $out = explode("\n", $this->Values);
            $out = array_filter($out, "Infusionsoft_DataFormField_isEmpty");
        } else {
            throw new Infusionsoft_Exception($this->Label . ' is not a drop down custom field.');
        }
        return $out;
    }

    public function setCustomFieldValues(array $customFieldValues){
        if($this->DataType == Infusionsoft_CustomFieldService::$DataType_Dropdown){
            $this->Values = "\n" . implode("\n", $customFieldValues);
        } else {
            throw new Infusionsoft_Exception($this->Label . ' is not a drop down custom field.');
        }

    }

    public function addCustomFieldValue($value){
        $values = $this->getCustomFieldValues();
        $values[] = $value;
        $this->setCustomFieldValues($values);
    }
}

function Infusionsoft_DataFormField_isEmpty($var){
    return !trim($var) == '';
}

