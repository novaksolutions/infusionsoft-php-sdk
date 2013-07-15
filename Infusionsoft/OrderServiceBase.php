<?php
class Infusionsoft_OrderServiceBase extends Infusionsoft_Service {
    public static function placeOrder($contactId, $creditCardId, $payPlanId, $productIds, $subscriptionPlanIds, $processSpecials, $promoCodes, $leadAffiliateId = 0, $affiliatedId = 0, Infusionsoft_App $app = null){
        $params = array(
            (int) $contactId,
            (int) $creditCardId,
            (int) $payPlanId,
            $productIds,
            $subscriptionPlanIds,
            (boolean) $processSpecials,
            $promoCodes,
            $leadAffiliateId,
            $affiliatedId
        );
        return parent::send($app, "OrderService.placeOrder", $params);
    }
}