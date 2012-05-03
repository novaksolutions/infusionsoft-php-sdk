<?php
    include('../infusionsoft.php');
    include('testUtils.php');

    Infusionsoft_CacheTools::clearObjectCaches(new Infusionsoft_DataFormField());

    $timestart = microtime(true);
    $out = Infusionsoft_CustomFieldService::getCachedCustomFields(new Infusionsoft_Contact());
    $elapsed_time_first = microtime(true) - $timestart;

    $timestart = microtime(true);
    $out = Infusionsoft_CustomFieldService::getCachedCustomFields(new Infusionsoft_Contact());
    $elapsed_time_second = microtime(true) - $timestart;

    if($elapsed_time_second < $elapsed_time_first){
        echo 'Success, caching saved: ' . ($elapsed_time_first - $elapsed_time_second) . ' seconds';
    } else {
        echo 'Failed, caching made it: ' . ($elapsed_time_second - $elapsed_time_first) . 'seconds longer';
    }