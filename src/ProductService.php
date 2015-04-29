<?php
namespace NovakSolutions\Infusionsoft;

class ProductService extends Service{
    public static function getInventory($id, App $app = null){
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
            (int) $id
        );

        return $app->send('ProductService.getInventory' , $params, true);
    }

    public static function setInventory($productId, $newInventory, App $app = null){

        $current_inventory = self::getInventory($productId);
        $total_change = abs($newInventory - $current_inventory);
        if ($total_change == 0){
            return true;
        }
        while ($current_inventory != $newInventory){
            if ($total_change <= 0){ //This is just to make sure it doesn't run too long. Only an odd change in inventory somewhere else at the same time might make this piece run
                return true;
            }
            if ($current_inventory > $newInventory){
                self::decrementInventory($productId);
            } elseif ($current_inventory < $newInventory){
                self::incrementInventory($productId);
            }
            $total_change--;
        }
    }

    public static function decrementInventory($productId, App $app = null){
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
            (int) $productId
        );

        return $app->send('ProductService.decrementInventory', $params, true);

    }

    public static function incrementInventory($id, App $app = null){
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
            (int) $id
        );

        return $app->send('ProductService.incrementInventory', $params, true);
    }

    public static function deactivateCreditCard($creditCardId, App $app = null){
        $params = array(
            (int) $creditCardId
        );
        return parent::send($app, "ProductService.deactivateCreditCard", $params);
    }
}