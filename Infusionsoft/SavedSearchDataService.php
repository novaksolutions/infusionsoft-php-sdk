<?php
/**
 * Created by JetBrains PhpStorm.
 * User: prescott
 * Date: 5/13/13
 * Time: 11:22 AM
 * To change this template use File | Settings | File Templates.
 */


class Infusionsoft_SavedSearchDataService extends Infusionsoft_Service {
    public static function queryWithOrderBy($object, $queryData, $orderByField = null, $ascending = true, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null){
        $results = array();

        $Settings = ClassRegistry::init("Settings.Setting");
        $savedSearchId = $Settings->getValue(get_class($object) . '.SavedSearchId');
        if($savedSearchId <= 0){
            throw new Exception("Saved Search Id For Object: " . get_class($object) . ' not set in settings, please set the setting: ' . get_class($object) . '.SavedSearchId' . ' to the saved search id');
        }

        $userId = $Settings->getValue('SavedSearchUserId');
        if($userId <= 0){
            throw new Exception("Saved Search UserId not set, please set the setting: " . 'SavedSearchUserId' . ' to a valid Infusionsoft UserId.');
        }

        $rows = Infusionsoft_SearchService::getSavedSearchResultsAllFields($savedSearchId, $userId, $page);
        $className = get_class($object);
        foreach($rows as $row){
            /**
             * @var Infusionsoft_Generated_Base $dataObject
             */
            if(isset($row['Follow-UpSequence'])){
                $row['FollowUpSequence'] = $row['Follow-UpSequence'];
            }
            $dataObject = new $className();
            $dataObject->loadFromArray($row, true);
            $results[] = $dataObject;
        }

        return $results;
    }
}