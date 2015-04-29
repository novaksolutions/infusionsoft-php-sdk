<?php
namespace NovakSolutions\Infusionsoft;

class Util
{
    public function contactSearch($search){
        $contacts = array();
        if(strpos($search, " ") !== false){
            $searchParts = explode(" ", $search);
            $criteria = array('FirstName' => $searchParts[0], 'LastName' => $searchParts[1]);
            $contacts = DataService::query(new Contact(), $criteria, 100);
            if(count($contacts) == 0){
                $criteria['LastName'] = $searchParts[1] . '%';
                $contacts = DataService::query(new Contact(), $criteria, 100);
            }
            if(count($contacts) == 0){
                $criteria['FirstName'] = $searchParts[0] . '%';
                $criteria['LastName'] = $searchParts[1];
                $contacts = DataService::query(new Contact(), $criteria, 100);
            }
            if(count($contacts) == 0){
                $criteria['FirstName'] = $searchParts[0] . '%';
                $criteria['LastName'] = $searchParts[1] . '%';
                $contacts = DataService::query(new Contact(), $criteria, 100);
            }
        }

        //Search By Email
        if(strpos($search, '@') !== false || count($contacts) == 0){
            $criteria = array('Email' => $search);
            $contacts = DataService::query(new Contact(), $criteria, 100);
            if(count($contacts) == 0){
                $criteria['Email'] = $search . '%';
                $contacts = DataService::query(new Contact(), $criteria, 100);
            }
        }


        if((strpos($search, "-") !== false && strpos($search, '@') == false) || count($contacts) == 0){
            $criteria = array();
            $criteria['Phone1'] = '%' . $search . '%';
            $contacts = DataService::query(new Contact(), $criteria, 100);
        }

        if(count($contacts) == 0){
            $criteria = array();
            $criteria['FirstName'] = $search;
            $contacts = DataService::query(new Contact(), $criteria, 100);
        }

        if(count($contacts) == 0){
            $criteria = array();
            $criteria['LastName'] = $search;
            $contacts = DataService::query(new Contact(), $criteria, 100);
        }

        if(count($contacts) == 0){
            $criteria = array();
            $criteria['FirstName'] = $search . '%';
            $contacts = DataService::query(new Contact(), $criteria, 100);
        }

        return $contacts;
    }
}
