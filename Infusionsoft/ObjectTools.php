<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Joey
 * Date: 5/3/12
 * Time: 2:19 PM
 * To change this template use File | Settings | File Templates.
 */
class Infusionsoft_ObjectTools{
    static function findObjectsInList(array $list, array $conditions){
        $matches = array();
        foreach($list as $object){
            $match = true;
            foreach($conditions as $field => $value){
                if($object->$field != $value){
                    $match = false;
                }
            }
            if($match){
                $matches[] = $object;
            }
        }

        return $matches;
    }
}
