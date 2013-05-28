<?php
class Infusionsoft_APIAffiliateService extends Infusionsoft_APIAffiliateServiceBase{
    //This will return an array of Commission objects, rather than data arrays
    public static function affCommissions($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null) {
        $commissionData =  parent::affCommissions($affiliateId, $filterStartDate, $filterEndDate, $app);

        $commissions = array();
        foreach ($commissionData as $index => $commissionDatum) {
            $commissionDatum['AffiliateId'] = $affiliateId;

            $commission = new Infusionsoft_Commission();
            $commission->loadFromArray($commissionDatum);

            $commissions[] = $commission;
        }

        return $commissions;
    }
}