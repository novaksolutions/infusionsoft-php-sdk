<?php
class Infusionsoft_CustomFieldService extends Infusionsoft_DataService{

    static $DataType_Name = 10;
    static $DataType_Email = 19;
    static $DataType_PhoneNumber = 1;
    static $DataType_Website = 18;
    static $DataType_SocialSecurityNumber = 2;
    static $DataType_State = 5;

    static $DataType_WholeNumber = 12;
    static $DataType_DecimalNumber = 11;
    static $DataType_Currency = 3;
    static $DataType_Percent = 4;

    static $DataType_Radio = 20;
    static $DataType_Dropdown = 21;
    static $DataType_Text = 15;
    static $DataType_TextArea = 16;
    static $DataType_YesNo = 6;
    static $DataType_Drilldown = 23;
    static $DataType_List = 17;

    static $DataType_Date = 13;
    static $DataType_DateTime = 14;
    static $DataType_DayOfWeek = 9;
    static $DataType_Year = 7;
    static $DataType_Month = 8;

    static $DataType_User = 22;
    static $DataType_UserListBox = 25;

    public static function getCachedCustomFields(Infusionsoft_Generated_Base $object, $dataType = null, $ttl = 43200 /*12 Hours*/, Infusionsoft_App $app = null){
        if(!property_exists($object, 'customFieldFormId')){
            throw new Infusionsoft_Exception(get_class($object) . ' does not have Custom Fields.');
        }

        $dataFormField = new Infusionsoft_DataFormField();
        if($object->getAppPoolAppKey() != null){
            $dataFormField->setAppPoolAppKey($object->getAppPoolAppKey());
        }

        $conditions = array('FormId' => $object->customFieldFormId);
        if($dataType != null){
            $conditions['DataType'] = $dataType;
        }
        $cache = new Infusionsoft_ObjectCache($dataFormField, $conditions, $ttl);
        $out = $cache->getData();

        return $out;
    }

	public static function getCustomFields(Infusionsoft_Generated_Base $object, $dataType = null, Infusionsoft_App $app = null){
        if(!property_exists($object, 'customFieldFormId')){
            throw new Infusionsoft_Exception(get_class($object) . ' does not have Custom Fields.');
        }

        $dataFormField = new Infusionsoft_DataFormField();
        if($object->getAppPoolAppKey() != null){
            $dataFormField->setAppPoolAppKey($object->getAppPoolAppKey());
        }

        $conditions = array('FormId' => $object->customFieldFormId);
        if($dataType != null){
            $conditions['DataType'] = $dataType;
        }
		$out = parent::query(new Infusionsoft_DataFormField(), $conditions, 1000, 0, false, $app);

		return $out;	
	}

    public static function getCustomField(Infusionsoft_Generated_Base $object, $name, Infusionsoft_App $app = null){
        if(strpos($name, '_') === 0){
            $name = substr($name, 1, strlen($name) - 1);
        }
        
        if(!property_exists($object, 'customFieldFormId')){
            throw new Infusionsoft_Exception(get_class($object) . ' does not have Custom Fields.');
        }

        $dataFormField = new Infusionsoft_DataFormField();
        if($object->getAppPoolAppKey() != null){
            $dataFormField->setAppPoolAppKey($object->getAppPoolAppKey());
        }

        $conditions = array('FormId' => $object->customFieldFormId, 'Name' => $name);
		$out = parent::query(new Infusionsoft_DataFormField(), $conditions, 1000, 0, false, $app);

		return array_pop($out);
	}


    public static function getAllValuesFor($field_name){
        $field_name = trim($field_name, '_');
        $fields = Infusionsoft_ObjectTools::findObjectsInList(Infusionsoft_CustomFieldService::getCachedCustomFields(new Infusionsoft_Contact()), array('Name' => $field_name));
        $field = array_shift($fields);
        $values = array();
        if (is_object($field)){
            $values = $field->getValues();
        }

        $keyed_array = array();
        foreach ($values as $value){
            $keyed_array[$value] = $value;
        }
        return $keyed_array;
    }


    public static $customFieldDataTypeList = array(
        1 => 'Phone',
        2 => 'SSN',
        3 => 'Currency',
        4 => 'Percent',
        5 => 'State',
        6 => 'YesNo',
        7 => 'Year',
        8 => 'Month',
        9 => 'DayOfWeek',
        10 => 'Name',
        11 => 'Decimal', // Not working
        12 => 'Number',
        13 => 'Date',
        14 => 'DateTime',
        15 => 'Text',
        16 => 'TextArea',
        17 => 'List Box', // Not Working
        18 => 'Website',
        19 => 'Email',
        20 => 'Radio',
        21 => 'Select',
        22 => 'User',
        23 => 'Drilldown',
        25 => 'UserBox' // Not Working
    );
}