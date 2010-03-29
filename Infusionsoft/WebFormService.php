<?php
class Infusionsoft_WebFormService extends Infusionsoft_Service{
	public static function ping(Infusionsoft_App $app){
		parent::ping($app, 'WebFormService');
	}
	
	public static function getMap(Infusionsoft_App $app){
		return $app->send("WebFormService.getMap", array());
	}
	
	public static function getHtml(Infusionsoft_App $app, $id){
		return $app->send("WebFormService.getHTML", array($id));
	}
}