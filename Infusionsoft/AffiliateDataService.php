<?php
/**
 * Created by JetBrains PhpStorm.
 * User: prescott
 * Date: 5/13/13
 * Time: 11:22 AM
 * To change this template use File | Settings | File Templates.
 */


class Infusionsoft_AffiliateDataService extends Infusionsoft_Service {
    static $firstOrderDate = null;
    static $affiliatesCache = null;
    static $orderByField = null;
    static $pageToMonthOMaps = array();
    //'DateEarned' is the only field for which ordering is supported.
    //If month is 0, all commissions for the current month will be returned
    public static function queryWithOrderBy($object, $queryData, $orderByField = null, $ascending = true, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null){
        if(self::$firstOrderDate === null) self::setFirstOrderDate();
        if(self::$firstOrderDate === false) return array();
        if(self::$affiliatesCache === null) self::populateAffiliateCache();
        if(self::$affiliatesCache === false) return array();

        $month = self::getMonthForPage($object, $page);
        $records = self::queryByMonthWithOrderBy($object, $queryData, $orderByField, $ascending, $limit, $month, $returnFields, $app);
        while($records !== false && count($records) == 0){
            $month++;
            $records = self::queryByMonthWithOrderBy($object, $queryData, $orderByField, $ascending, $limit, $month, $returnFields, $app);
        }
        self::setPageForMonth($object, $month, $page);
        return $records;
    }

    public static function queryByMonthWithOrderBy($object, $queryData, $orderByField, $ascending = true, $limit = 1000, $month = 0, $returnFields = false, Infusionsoft_App $app = null){
        //Calculate beginning of this month
        $startDate = date('Y-m-01 00:00:00', strtotime(" - $month months"));
        $startDate = date(Infusionsoft_Service::apiDateFormat, strtotime($startDate));

        $endDate = date('Y-m-d 23:59:59', strtotime($startDate . ' + 1 month - 1 day'));
        $endDate = date(Infusionsoft_Service::apiDateFormat, strtotime($endDate));

        if (strtotime($startDate) < strtotime(self::$firstOrderDate) || strtotime($startDate) < strtotime("2000-01-01")){
            return false;
        }

        //Now get all of the commissions or clawbacks from each one
        $objects = array();
        foreach (self::$affiliatesCache as $affiliate) {
            if (get_class($object) == 'Infusionsoft_Commission'){
                $objects = array_merge(
                    $objects,
                    Infusionsoft_APIAffiliateService::affCommissions($affiliate->Id, $startDate, $endDate, $app)
                );
            } elseif (get_class($object) == 'Infusionsoft_Clawback'){
                $objects = array_merge(
                    $objects,
                    Infusionsoft_APIAffiliateService::affClawbacks($affiliate->Id, $startDate, $endDate, $app)
                );
            }
        }

        if($orderByField != null){
            self::$orderByField = $orderByField;
            usort($objects, array('Infusionsoft_AffiliateDataService', 'sortCommissions'));
        }

        return $objects;
    }

    public static function sortCommissions($a, $b){
        return $a->{self::$orderByField} < $b->{self::$orderByField};
    }

    private static function getMonthForPage($object, $page){
        $className = get_class($object);
        if(!isset(self::$pageToMonthOMaps[$className])){
            self::$pageToMonthOMaps[$className] = array();
            if($page == 0){
                self::$pageToMonthOMaps[$className][$page] = 0;
            } else {
                throw new Exception("The Affiliate Data Service MUST have pages accessed in order.");
            }
        }


        if(!isset(self::$pageToMonthOMaps[$className][$page])){
            end(self::$pageToMonthOMaps[$className]);
            return self::$pageToMonthOMaps[$className][key(self::$pageToMonthOMaps[$className])] + 1;
        } else{
            return self::$pageToMonthOMaps[$className][$page];
        }
    }

    private static function setPageForMonth($object, $month, $page){
        $className = get_class($object);
        if(!isset(self::$pageToMonthOMaps[$className])){
            self::$pageToMonthOMaps[$className] = array();
        }
        self::$pageToMonthOMaps[$className][$page][$month];
    }

    private static function setFirstOrderDate(){
        $firstOrder = Infusionsoft_DataService::queryWithOrderBy(new Infusionsoft_Job(), array('Id' => '%'), 'DateCreated', true, 1);
        if (!empty($firstOrder)){
            $firstOrder = array_shift($firstOrder);
            self::$firstOrderDate = $firstOrder->DateCreated;
        } else {
            self::$firstOrderDate = false;
        }
    }

    private static function populateAffiliateCache(){
        $page = 0;
        $pageSize = 1000;
        self::$affiliatesCache = array();
        do {
            $affiliatesPage = Infusionsoft_DataService::query(
                new Infusionsoft_Affiliate(),
                array('Id' => '%'),
                $pageSize,
                $page,
                array('Id')
            );
            $page += 1;
            self::$affiliatesCache = array_merge(self::$affiliatesCache, $affiliatesPage);
        } while (sizeof($affiliatesPage) == $pageSize);
    }
}