<?php
namespace NovakSolutions\Infusionsoft;

abstract class BaseWithCustomFields extends Base{
    public static function fieldExists($field){
        return (array_search($field, static::$tableFields) !== false);
    }

    public static function addCustomField($name){
        static::$tableFields[] = $name;
    }

    public function addCustomFields(array $fields){
        foreach($fields as $name){
            static::addCustomField($name);
        }
    }
}
