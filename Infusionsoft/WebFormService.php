<?php
class Infusionsoft_WebFormService extends Infusionsoft_Service{
	public static function ping(Infusionsoft_App $app = null){
		parent::ping('WebFormService', $app);
	}
	
	public static function getMap(Infusionsoft_App $app = null){
		$app = parent::getAppIfNull($app);
		return $app->send("WebFormService.getMap", array());
	}
	
	public static function getHTML($id, Infusionsoft_App $app = null){
		$app = parent::getDefaultAppIfNull($app);
		return $app->send("WebFormService.getHTML", array($id));
	}
}