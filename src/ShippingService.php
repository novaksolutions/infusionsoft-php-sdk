<?php
namespace NovakSolutions\Infusionsoft;

class ShippingService extends Service{

    public static function getAllShippingOptions(App $app = null){
        $params = array(
        );

        return parent::send($app, "ShippingService.getAllShippingOptions", $params);
    }

    public static function getAllConfiguredShippingOptions(App $app = null){
        $params = array(
        );

        return parent::send($app, "ShippingService.getAllShippingOptions", $params);
    }

    public static function getFlatRateShippingOption($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getFlatRateShippingOption", $params);
    }

    public static function getOrderTotalShippingOption($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getOrderTotalShippingOption", $params);
    }

    public static function getOrderTotalShippingRanges($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getOrderTotalShippingRanges", $params);
    }

    public static function getProductBasedShippingOption($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getProductBasedShippingOption", $params);
    }

    public static function getProductShippingPricesForProductShippingOption($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getProductShippingPricesForProductShippingOption", $params);
    }

    public static function getOrderQuantityShippingOption($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getOrderQuantityShippingOption", $params);
    }

    public static function getWeightBasedShippingOption($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getWeightBasedShippingOption", $params);
    }

    public static function getWeightBasedShippingRanges($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getWeightBasedShippingRanges", $params);
    }

    public static function getUpsShippingOption($optionId, App $app = null){
        $params = array(
            (int) $optionId
        );

        return parent::send($app, "ShippingService.getUpsShippingOption", $params);
    }
}
