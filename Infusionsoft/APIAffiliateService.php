<?php
class Infusionsoft_APIAffiliateService extends Infusionsoft_APIAffiliateServiceBase{
    //This will return an array of Commission objects, rather than data arrays
    public static function affCommissions($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null) {
        $commissionData =  parent::affCommissions($affiliateId, $filterStartDate, $filterEndDate, $app);

        $commissions = array();
        foreach ($commissionData as $index => $commissionDatum) {
            //The API service doesn't return AffId, but it is part of the object
            $commissionDatum['Id'] = $affiliateId.'/'.$commissionDatum['InvoiceId'].'/'.$commissionDatum['DateEarned'].'/'.$index;
            $commissionDatum['AffiliateId'] = $affiliateId;

            $commission = new Infusionsoft_Commission();
            $commission->loadFromArray($commissionDatum);

            $commissions[] = $commission;
        }

        return $commissions;
    }

    public static function affClawbacks($affiliateId, $filterStartDate, $filterEndDate, Infusionsoft_App $app = null) {
        $clawbacksData =  parent::affClawbacks($affiliateId, $filterStartDate, $filterEndDate, $app);

        $clawbacks = array();
        foreach ($clawbacksData as $index => $clawbackDatum) {
            //The API service doesn't return AffId, but it is part of the object
            $clawbackDatum['Id'] = $affiliateId.'/'.$clawbackDatum['InvoiceId'].'/'.$clawbackDatum['DateEarned'].'/'.$index;
            $clawbackDatum['AffiliateId'] = $affiliateId;

            $clawback = new Infusionsoft_Clawback();
            $clawback->loadFromArray($clawbackDatum);

            $clawbacks[] = $clawback;
        }

        return $clawbacks;
    }
    
    
}