<?php
namespace NovakSolutions\Infusionsoft;

class ObjectTools{
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
