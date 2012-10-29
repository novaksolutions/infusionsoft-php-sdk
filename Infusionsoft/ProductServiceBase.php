<?php
class Infusionsoft_ProductServiceBase extends Infusionsoft_Service{

    public static function deactivateCreditCard($creditCardId, Infusionsoft_App $app = null){
        $params = array(
            (int) $creditCardId
        );
        return parent::send($app, "ProductService.deactivateCreditCard", $params);
    }
}