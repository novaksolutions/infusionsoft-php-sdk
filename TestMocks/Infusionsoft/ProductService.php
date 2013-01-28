<?php
class Infusionsoft_ProductService extends Infusionsoft_ProductServiceBase{
    static $runCounts = array();
    /**
     * @param $productId
     * @param Infusionsoft_App $app
     *
     * @return The inventory of the product, when testing, returns the product id.
     */
    public static function getInventory($productId, Infusionsoft_App $app = null){
        self::incrementMethod('getInventory');
        return $productId;
    }

    public static function setInventory($productId, $inventory){
        self::incrementMethod('setInventory');
        return 1;
    }

    public static function incrementInventory($productId, Infusionsoft_App $app = null){
        return 1;
    }


    public static function decrementInventory($productId, Infusionsoft_App $app = null){
        return 1;
    }

    public static function increaseInventory($productId, $quantity, Infusionsoft_App $app = null){
        return 1;
    }

    public static function decreaseInventory($productId, $quantity, Infusionsoft_App $app = null){
        return 1;
    }

    public static function hello(Infusionsoft_App $app = null){
        return 1;
    }

    public static function getMethodRunCount($methodName){
        if(isset(self::$runCounts[$methodName])){
            return self::$runCounts[$methodName];
        } else {
            return 0;
        }

    }

    public static function incrementMethod($methodName){
        if(isset(self::$runCounts[$methodName])){
            self::$runCounts[$methodName]++;
        } else {
            self::$runCounts[$methodName] = 1;
        }
    }
}