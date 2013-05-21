<?php
/**
 * Created by JetBrains PhpStorm.
 * User: prescott
 * Date: 5/13/13
 * Time: 11:22 AM
 * To change this template use File | Settings | File Templates.
 */


class Infusionsoft_AffiliateDataService extends Infusionsoft_Service {
    //'DateEarned' is the only field for which ordering is supported.
    //If month is 0, all commissions for the current month will be returned
    public static function queryWithOrderBy($object, $queryData, $orderByField, $ascending = true, $limit = 1000, $month = 0, $returnFields = false, Infusionsoft_App $app = null){
        //Calculate beginning of this month
        $startDate = new DateTime(date('Y-m-01')); //first day of this month
        $startDate = date_sub($startDate, new DateInterval('P'.$month.'M')); //$month months before the start of this month
        $startDate = $startDate->format(Infusionsoft_Service::apiDateFormat); //format as string

        $endDate = new DateTime(date('Y-M-01')); //first of this month
        $endDate = date_sub($endDate, new DateInterval('P'. $month . 'M')); //same as$startDate
        $endDate = date_add($endDate, new DateInterval('P1M')); // one month later
        $endDate = $endDate->format(Infusionsoft_Service::apiDateFormat);

        //get an array of all affiliates
        $affiliates = array();
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

        //Now get all of the commissions from each one
        $commissions = array();
        foreach ($affiliates as $affiliate) {
            $commissions = array_merge(
                $commissions,
                Infusionsoft_APIAffiliateService::affCommissions($affiliate->Id, $startDate, $endDate, $app)
            );
        }

        return $commissions;
    }
}