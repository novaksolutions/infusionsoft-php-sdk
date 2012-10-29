<?php
class Infusionsoft_ProductService extends Infusionsoft_ProductServiceBase{
	public static function ping(Infusionsoft_App $app = null){
		return parent::ping('ProductService', $app);
	}
}