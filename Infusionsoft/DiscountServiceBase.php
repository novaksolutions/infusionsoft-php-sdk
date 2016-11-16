<?php
class Infusionsoft_DiscountServiceBase extends Infusionsoft_Service{

    public static function getOrderTotalDiscount($discountId, Infusionsoft_App $app = null){
        $params = array(
            (int) $discountId
        );

        return parent::send($app, "DiscountService.getOrderTotalDiscount", $params);
    }

}