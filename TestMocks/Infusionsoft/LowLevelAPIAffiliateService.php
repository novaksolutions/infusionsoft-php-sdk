<?php


class Infusionsoft_LowLevelAPIAffiliateService extends Infusionsoft_LowLevelMockService{

    public function __construct(){

    }

    public function setData($data){
        $this->data = $data;
    }

    public static function affPayouts($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null){
        $params = array(
            (int) $affiliateId,
            $filterStartDate,
            $filterEndDate
        );

        return parent::send($app, "APIAffiliateService.affPayouts", $params);
    }

    public function affCommissions($args){
        array_shift($args);
        list($affiliateId, $filterStartDate, $filterEndDate) = $args;

        $matchingCommissions = array();
        foreach($this->data as $commission){
            if($commission['AffiliateId'] == $affiliateId && strtotime($commission['DateEarned']) >= strtotime($filterStartDate) && strtotime($commission['DateEarned']) < strtotime($filterEndDate)){
                $matchingCommissions[] = $commission;
            }
        }
        return $matchingCommissions;
    }

    public static function affClawbacks($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null){
        $params = array(
            (int) $affiliateId,
            $filterStartDate,
            $filterEndDate
        );

        return parent::send($app, "APIAffiliateService.affClawbacks", $params);
    }

    public static function affSummary($affiliateIds, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null){
        $params = array(
            $affiliateIds,
            $filterStartDate,
            $filterEndDate
        );

        return parent::send($app, "APIAffiliateService.affSummary", $params);
    }

    public static function affRunningTotals($affiliateIds, Infusionsoft_App $app = null){
        $params = array(
            $affiliateIds
        );

        return parent::send($app, "APIAffiliateService.affRunningTotals", $params);
    }

    public static function updatePhoneStats($firstName, $lastName, $calls, $totalTime, $averageTime, Infusionsoft_App $app = null){
        $params = array(
            $firstName,
            $lastName,
            (int) $calls,
            $totalTime,
            $averageTime
        );

        return parent::send($app, "APIAffiliateService.updatePhoneStats", $params);
    }
}


