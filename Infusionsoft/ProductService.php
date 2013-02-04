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
}