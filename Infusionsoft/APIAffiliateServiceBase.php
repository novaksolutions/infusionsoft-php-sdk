<?php
class Infusionsoft_APIAffiliateServiceBase extends Infusionsoft_Service{

    public static function affPayouts($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null){
        $params = array(
            (int) $affiliateId, 
            $filterStartDate, 
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affPayouts", $params);
    }
    
    public static function affCommissions($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null){
        $params = array(
            (int) $affiliateId, 
            $filterStartDate, 
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affCommissions", $params, null, true);
    }
    
    public static function affClawbacks($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null){
        $params = array(
            (int) $affiliateId, 
            $filterStartDate, 
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affClawbacks", $params);
    }
    
    public static function affSummary($affiliateIds, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null){
        $params = array(
            $affiliateIds, 
            $filterStartDate, 
            $filterEndDate
        );

        return parent::send($app, "AffiliateService.affSummary", $params);
    }
    
    public static function affRunningTotals($affiliateIds, Infusionsoft_App $app = null){
        $params = array(
            $affiliateIds
        );

        return parent::send($app, "AffiliateService.affRunningTotals", $params);
    }
    
    public static function updatePhoneStats($firstName, $lastName, $calls, $totalTime, $averageTime, Infusionsoft_App $app = null){
        $params = array(
            $firstName, 
            $lastName, 
            (int) $calls, 
            $totalTime, 
            $averageTime
        );

        return parent::send($app, "AffiliateService.updatePhoneStats", $params);
    }

    public static function getRedirectLinksForAffiliate($affiliateId, Infusionsoft_App $app = null){
        $params = array(
            (int) $affiliateId
        );

        return parent::send($app, "AffiliateService.getRedirectLinksForAffiliate", $params);
    }


    
}