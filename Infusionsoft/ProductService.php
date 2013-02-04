<?php
class Infusionsoft_ProductService extends Infusionsoft_ProductServiceBase{
	public static function ping(Infusionsoft_App $app = null){
		return parent::ping('ProductService', $app);
	}

    public static function getInventory($id, Infusionsoft_App $app = null){
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
            (int) $id
        );

        return $app->send('ProductService.getInventory' , $params, true);
    }

    public static function setInventory($id, $new_inventory, Infusionsoft_App $app = null){

        $current_inventory = self::getInventory($id);
        $total_change = abs($new_inventory - $current_inventory);
        if ($total_change == 0){
            return true;
        }
        while ($current_inventory != $new_inventory){
            if ($total_change <= 0){ //This is just to make sure it doesn't run too long. Only an odd change in inventory somewhere else at the same time might make this piece run
                return true;
            }
            if ($current_inventory > $new_inventory){
                self::decrementInventory($id);
            } elseif ($current_inventory < $new_inventory){
                self::incrementInventory($id);
            }
            $total_change--;
        }
    }

    public static function decrementInventory($id, Infusionsoft_App $app = null){
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
            (int) $id
        );

        return $app->send('ProductService.decrementInventory', $params, true);

    }

    public static function incrementInventory($id, Infusionsoft_App $app = null){
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
            (int) $id
        );

        return $app->send('ProductService.incrementInventory', $params, true);
    }
}