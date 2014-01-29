<?php
/**
 * Created by JetBrains PhpStorm.
 * User: prescott
 * Date: 5/13/13
 * Time: 11:22 AM
 * To change this template use File | Settings | File Templates.
 */


class Infusionsoft_AffiliateDataService extends Infusionsoft_Service {
    static $first_run = false;
    static $done = false;
    static $first_order_date = null;
    static $earliest_month_to_query = null;
    static $affiliates_cache = array();
    static $orderByField = 'DateEarned';
    //'DateEarned' is the only field for which ordering is supported.
    //If month is 0, all commissions for the current month will be returned
    public static function queryWithOrderBy($object, $queryData, $orderByField, $ascending = true, $limit = 1000, $month = 0, $returnFields = false, Infusionsoft_App $app = null){
        //Calculate beginning of this month
        $startDate = date('Y-m-01 00:00:00', strtotime(" - $month months"));
        $startDate = date(Infusionsoft_Service::apiDateFormat, strtotime($startDate));

        $endDate = date('Y-m-d 23:59:59', strtotime($startDate . ' + 1 month - 1 day'));
        $endDate = date(Infusionsoft_Service::apiDateFormat, strtotime($endDate));

        if (self::$first_run === true && !empty(self::$first_order_date) && strtotime($startDate) < strtotime(self::$first_order_date)){
            self::$done = true;
        }
        if (!empty(self::$earliest_month_to_query)){
            if (strtotime($startDate) < strtotime(self::$earliest_month_to_query)){
                self::$done = true;
            }
        }
        //get an array of all affiliates
        $affiliates = self::$affiliates_cache;
        if (empty($affiliates)){
            $page = 0;
            do {
                $affiliatesPage = Infusionsoft_DataService::query(
                    new Infusionsoft_Affiliate(),
                    array('Id' => '%'),
                    1000,
                    $page,
                    array('Id'),
                    $app
                );
                $page += 1;
                $affiliates = array_merge($affiliates, $affiliatesPage);
            } while (sizeof($affiliatesPage) >= 1000);
        }

        if (self::$first_run === true && self::$first_order_date === null){
            $firstOrder = Infusionsoft_DataService::queryWithOrderBy(new Infusionsoft_Job(), array('Id' => '%'), 'Id', true, 1);
            if (!empty($firstOrder)){
                self::$first_order_date = $firstOrder[0]->DateCreated;
            } else {
                self::$first_order_date = false;
            }
        }

        //Now get all of the commissions from each one
        $objects = array();
        foreach ($affiliates as $affiliate) {
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

        self::$orderByField = $orderByField;
        usort($objects, array('Infusionsoft_AffiliateDataService', 'sortCommissions'));
        return $objects;
    }

    public static function sortCommissions($a, $b){
        return $a->{self::$orderByField} < $b->{self::$orderByField};
    }
}