<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Joey
 * Date: 2/16/12
 * Time: 2:22 PM
 * To change this template use File | Settings | File Templates.
 */

class Infusionsoft_Util
{
    public static function removeBrokenFields(){
        try{
            $remove_field_cache = new Infusionsoft_RemoveFieldsCache();
            $fields_to_remove = $remove_field_cache->getData();
            if($fields_to_remove !== false){
                foreach($fields_to_remove as $object_name => $fields){
                    $object = new $object_name();
                    foreach($fields as $field){
                        $object->removeField($field);
                    }
                }
            }
        }catch(Exception $e){

        }
    }
}
