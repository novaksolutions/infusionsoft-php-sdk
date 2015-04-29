<?php
namespace NovakSolutions\Infusionsoft;

class APIAffiliateService extends Base{
    //This will return an array of Commission objects, rather than data arrays
    public static function affCommissions($affiliateId, $filterStartDate, $filterEndDate, App $app = null) {
        $commissionData =  self::affCommissionsRaw($affiliateId, $filterStartDate, $filterEndDate, $app);

        $commissions = array();
        foreach ($commissionData as $index => $commissionDatum) {
            //The API service doesn't return AffId, but it is part of the object
            $commissionDatum['Id'] = $affiliateId.'/'.$commissionDatum['InvoiceId'].'/'.$commissionDatum['DateEarned'].'/'.$index;
            $commissionDatum['AffiliateId'] = $affiliateId;

            $commission = new Commission();
            $commission->loadFromArray($commissionDatum);

            $commissions[] = $commission;
        }

        return $commissions;
    }



    public static function affClawbacks($affiliateId, $filterStartDate, $filterEndDate, App $app = null) {
        $clawbacksData =  self::affClawbacksRaw($affiliateId, $filterStartDate, $filterEndDate, $app);

        $clawbacks = array();
        foreach ($clawbacksData as $index => $clawbackDatum) {
            //The API service doesn't return AffId, but it is part of the object
            $clawbackDatum['Id'] = $affiliateId.'/'.$clawbackDatum['InvoiceId'].'/'.$clawbackDatum['DateEarned'].'/'.$index;
            $clawbackDatum['AffiliateId'] = $affiliateId;

            $clawback = new Clawback();
            $clawback->loadFromArray($clawbackDatum);

            $clawbacks[] = $clawback;
        }

        return $clawbacks;
    }

    public static function affPayouts($affiliateId, $filterStartDate, $filterEndDate, App $app = null){
        $params = array(
            (int) $affiliateId,
            $filterStartDate,
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affPayouts", $params);
    }

    public static function affCommissionsRaw($affiliateId, $filterStartDate, $filterEndDate, App $app = null){
        $params = array(
            (int) $affiliateId,
            $filterStartDate,
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affCommissions", $params, null, true);
    }

    public static function affClawbacksRaw($affiliateId, $filterStartDate, $filterEndDate, App $app = null){
        $params = array(
            (int) $affiliateId,
            $filterStartDate,
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affClawbacks", $params);
    }

    public static function affSummary($affiliateIds, $filterStartDate, $filterEndDate, App $app = null){
        $params = array(
            $affiliateIds,
            $filterStartDate,
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affSummary", $params);
    }

    public static function affRunningTotals($affiliateIds, App $app = null){
        $params = array(
            $affiliateIds
        );

        return parent::send($app, "AffiliateService.affRunningTotals", $params);
    }

    public static function updatePhoneStats($firstName, $lastName, $calls, $totalTime, $averageTime, App $app = null){
        $params = array(
            $firstName,
            $lastName,
            (int) $calls,
            $totalTime,
            $averageTime
        );

        return parent::send($app, "AffiliateService.updatePhoneStats", $params);
    }

    public static function getRedirectLinksForAffiliate($affiliateId, App $app = null){
        $params = array(
            (int) $affiliateId
        );

        return parent::send($app, "AffiliateService.getRedirectLinksForAffiliate", $params);
    }


}