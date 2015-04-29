<?php
namespace NovakSolutions\Infusionsoft;

class SearchService extends Service {
    public static function getAllReportColumns($savedSearchId, $userId, App $app = null){
        $params = array(
            (int) $savedSearchId,
            (int) $userId,
        );

        return parent::send($app, "SearchService.getAllReportColumns", $params);
    }

    public static function getSavedSearchResults($savedSearchId, $userId, $pageNumber, array $returnFields, App $app = null){
        $params = array(
            (int) $savedSearchId,
            (int) $userId,
            (int) $pageNumber,
            $returnFields
        );

        return parent::send($app, "SearchService.getSavedSearchResults", $params);
    }

    public static function getSavedSearchResultsAllFields($savedSearchId, $userId, $pageNumber, App $app = null){
        $params = array(
            (int) $savedSearchId,
            (int) $userId,
            (int) $pageNumber,
        );

        return parent::send($app, "SearchService.getSavedSearchResultsAllFields", $params);
    }

    public static function getAvailableQuickSearches($userId, App $app = null){
        $params = array(
            (int) $userId,
        );

        return parent::send($app, "SearchService.getAvailableQuickSearches", $params);
    }

    public static function quickSearch($quickSearchType, $userId, $searchData, $page, $returnLimit, App $app = null){
        $params = array(
            (string) $quickSearchType,
            (int) $userId,
            (string) $searchData,
            (int) $page,
            (int) $returnLimit
        );

        return parent::send($app, "SearchService.quickSearch", $params);
    }

    public static function getDefaultQuickSearch($userId, App $app = null){
        $params = array(
            (int) $userId,
        );

        return parent::send($app, "SearchService.getDefaultQuickSearch", $params);
    }

    public static function getSavedSearchIdFromName($savedSearchName){
        $results = DataService::query(new SavedFilter(), array('FilterName' => $savedSearchName));
        if(count($results) > 0){
            return array_shift($results);
        } else {
            return false;
        }
    }
}
