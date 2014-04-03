<?php
class Infusionsoft_ShippingServiceBase extends Infusionsoft_Service{

    public static function getAllShippingOptions(Infusionsoft_App $app = null){
        $params = array(
        );

        return parent::send($app, "ShippingService.getAllShippingOptions", $params);
    }

    public static function getAllConfiguredShippingOptions(Infusionsoft_App $app = null){
        $params = array(
        );

        return parent::send($app, "ShippingService.getAllShippingOptions", $params);
    }

    public static function getFlatRateShippingOption($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getFlatRateShippingOption", $params);
    }

    public static function getOrderTotalShippingOption($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getOrderTotalShippingOption", $params);
    }

    public static function getOrderTotalShippingRanges($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getOrderTotalShippingRanges", $params);
    }

    public static function getProductBasedShippingOption($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getProductBasedShippingOption", $params);
    }

    public static function getProductShippingPricesForProductShippingOption($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getProductShippingPricesForProductShippingOption", $params);
    }

    public static function getOrderQuantityShippingOption($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getOrderQuantityShippingOption", $params);
    }

    public static function getWeightBasedShippingOption($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getWeightBasedShippingOption", $params);
    }

    public static function getWeightBasedShippingRanges($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getWeightBasedShippingRanges", $params);
    }

    public static function getUpsShippingOption($optionId, Infusionsoft_App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getUpsShippingOption", $params);
    }

}
