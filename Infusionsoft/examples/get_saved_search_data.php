<?php
include('../infusionsoft.php');
$savedSearchResults = array();
//I don't remember if the first page is 0 or 1, so change this if you need to.

$page = 0;
$userId = 1;
$savedSearchId = 141;
do{
    $savedSearchResults = Infusionsoft_SearchService::getSavedSearchResultsAllFields($savedSearchId, $userId, $page);
    $page++;
    //Do stuff with saved search results here...
    var_dump($savedSearchResults);

} while(count($savedSearchResults) > 0);
