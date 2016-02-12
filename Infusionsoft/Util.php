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

    public static function contactSearch($search){
        $contacts = array();
        if(strpos($search, " ") !== false){
            $searchParts = explode(" ", $search);
            $criteria = array('FirstName' => $searchParts[0], 'LastName' => $searchParts[1]);
            $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
            if(count($contacts) == 0){
                $criteria['LastName'] = $searchParts[1] . '%';
                $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
            }
            if(count($contacts) == 0){
                $criteria['FirstName'] = $searchParts[0] . '%';
                $criteria['LastName'] = $searchParts[1];
                $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
            }
            if(count($contacts) == 0){
                $criteria['FirstName'] = $searchParts[0] . '%';
                $criteria['LastName'] = $searchParts[1] . '%';
                $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
            }
        }

        //Search By Email
        if(strpos($search, '@') !== false || count($contacts) == 0){
            $criteria = array('Email' => $search);
            $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
            if(count($contacts) == 0){
                $criteria['Email'] = $search . '%';
                $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
            }
        }


        if((strpos($search, "-") !== false && strpos($search, '@') == false) || count($contacts) == 0){
            $criteria = array();
            $criteria['Phone1'] = '%' . $search . '%';
            $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
        }

        if(count($contacts) == 0){
            $criteria = array();
            $criteria['FirstName'] = $search;
            $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
        }

        if(count($contacts) == 0){
            $criteria = array();
            $criteria['LastName'] = $search;
            $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
        }

        if(count($contacts) == 0){
            $criteria = array();
            $criteria['FirstName'] = $search . '%';
            $contacts = Infusionsoft_DataService::query(new Infusionsoft_Contact(), $criteria, 100);
        }

        return $contacts;
    }
}
