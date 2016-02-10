<?php

//This service will populate returned objects with a compound key for the Id.  This facilitates use with iDos (A Proprietery NovakSolutions Sync tool).

class Infusionsoft_ContactGroupAssignDataService extends Infusionsoft_DataService {
    static $lastProcessedContactId = 0;
    public static function queryWithOrderBy($object, $queryData, $orderByField = null, $ascending = true, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null){
        if(PHP_INT_SIZE < 8){
            throw new Exception("This version oh php is not 64 bit it is " . PHP_INT_SIZE * 8 . ' bit.  ContactGroupAssign cannot be synced unless running on a 64bit version of php.');
        }

        Infusionsoft_ContactGroupAssign::removeField('Id');
        if(is_array($returnFields) && in_array('Id', $returnFields)){
            unset($returnFields[array_search('Id', $returnFields)]);
            $returnFields[] = 'ContactId';
            $returnFields[] = 'GroupId';
            $returnFields = array_values($returnFields);
        }

        $results = Infusionsoft_DataService::queryWithOrderBy($object, $queryData, $orderByField, $ascending, $limit, $page, $returnFields, $app);

        Infusionsoft_ContactGroupAssign::addCustomField('Id');
        self::addCompoundKeyToResults($results);

        if($orderByField == 'ContactId' && $ascending && count($results) > 0){
            if($page > 0){
                self::removeRecordsForContactsAlreadyProcessed(self::$lastProcessedContactId, $results);
            }
            $lastRecordOfResultSet = end($results);
            $lastContactId = $lastRecordOfResultSet->ContactId;
            self::$lastProcessedContactId = $lastContactId;
            $foundLastRecordForLastContact = false;
            $extraPages = 1;
            while(!$foundLastRecordForLastContact && count($results) > 0){
                Infusionsoft_ContactGroupAssign::removeField('Id');
                $extraResults = Infusionsoft_DataService::queryWithOrderBy($object, $queryData, $orderByField, $ascending, $limit, $page + $extraPages, $returnFields, $app);
                Infusionsoft_ContactGroupAssign::addCustomField('Id');
                self::addCompoundKeyToResults($extraResults);
                foreach($extraResults as $extraResult){
                    //If somehow, between calls, a lot of tags are applied, and our "last" contact gets pushed down to the second page, we need to not break because of new contacts higher up on the page.
                    if($extraResult->ContactId <= $lastContactId){
                        $results[] = $extraResult;
                    } else {
                        $foundLastRecordForLastContact = true;
                        break;
                    }
                }
                if(count($extraResults) == 0){
                    $foundLastRecordForLastContact = true;
                }
                $extraPages++;
            }
            return $results;
        }
        /** @var Infusionsoft_ContactGroupAssign $result */


        return $results;
    }

    public static function addCompoundKeyToResults(array &$results){
        foreach($results as &$result){
            $result->Id = $result->ContactId * 10000000 + $result->GroupId;
        }
    }

    /**
     * @param $results
     */
    public static function removeRecordsForContactsAlreadyProcessed($lastProcessedContactId, &$results){
        /** @var Infusionsoft_ContactGroupAssign $result */
        foreach ($results as $key => $result) {
            if ($result->ContactId <= $lastProcessedContactId) {
                unset($results[$key]);
            } else {
                return;
            }
        }
    }
}