<?php
namespace NovakSolutions\Infusionsoft;

abstract class Base
{
    const CUSTOM_FIELD_FORM_ID = 0;

    protected $fields;
    protected $table;
    protected $data = array();
    protected $appPoolAppKey = null;

    public function __construct($table, $id = null, $app = null)
    {
        $this->table = $table;
        if($id != null){
            $this->load($id, $app);
        }
    }

    public function getTable()
    {
        return $this->table;
    }

    public function load($id, $app = null)
    {
        $object = DataService::load($this, $id, false, $app);
        $this->loadFromObject($object);
        if($this->Id == ''){
            throw new Exception("Could not load " . $this->table . " with id " . $id);
        }

        SdkEventManager::dispatch(new SdkEvent($this), 'DataObject.Loaded');
    }

    public function save($app = null)
    {
        $result = DataService::save($this, $app);
        SdkEventManager::dispatch(new SdkEvent($this, array('result' => $result)), 'DataObject.Saved');
        return $result;
    }

    public function delete($app = null)
    {
        if($this->Id > 0){
            $result = DataService::delete($this, $this->Id, $app);
            SdkEventManager::dispatch(new SdkEvent($this, array('result' => $result)), 'DataObject.Deleted');
        } else {
            throw new Exception("Trying to delete a blank contact");
        }

        return $result;
    }

    public function loadFromArray($data, $fast = false)
    {
        if($fast){
            $this->data = $data;
        } else {
            foreach ($this->getFields() as $field){
                $this->$field = NULL;
                if ($data && is_array($data) && isset($data[$field])){
                    $this->$field = $data[$field];
                }
            }
        }
    }

    public function loadFromObject($object)
    {
        if(method_exists($object, "getAppPoolAppKey")){
            $this->setAppPoolAppKey($object->getAppPoolAppKey());
        }
        if(is_object($object)){
            foreach ($this->getFields() as $field){
                $this->$field = NULL;
                $this->$field = $object->$field;
            }
        }else{
            throw new Exception("Tried to load object " . $this->getTable() . " with loadFromObject from non object.");
        }
    }

    public function __set($name, $value)
    {
        if($this->isValidField($name)){
            $this->data[$name] = $value;
        }else{
            throw new Exception("Invalid Field Name: " . $name);
        }
    }

    public function __get($name)
    {
        if($this->isValidField($name)){
            if(isset($this->data[$name])){
                return $this->data[$name];
            }else{
                return null;
            }
        }else{
            throw new Exception("Invalid Field Name: " . $name);
            return '';
        }
    }

    public function isEmpty()
    {
        foreach($this->getFields() as $fieldName){
            if($this->$fieldName != '') return false;
        }
        return true;
    }

    public function isValidField($name)
    {
        return in_array($name, $this->getFields());
    }

    public function setAppPoolAppKey($appPoolAppKey)
    {
        $this->appPoolAppKey = $appPoolAppKey;
    }

    public function getAppPoolAppKey()
    {
        return $this->appPoolAppKey;
    }

    public function toArray()
    {
        return $this->data;
    }


    public static function getFields(){
        return static::$tableFields;
    }

    public static function removeField($fieldName){
        $fieldIndex = array_search($fieldName, static::$tableFields);
        if($fieldIndex !== false){
            unset(static::$tableFields[$fieldIndex]);
            static::$tableFields = array_values(static::$tableFields);
        }
    }

    public static function getCustomFieldFormId(){
        return static::CUSTOM_FIELD_FORM_ID;
    }

    public static function blankClass(){
        $className = get_called_class();
        return new $className();
    }
}
