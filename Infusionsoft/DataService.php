<?php
class Infusionsoft_DataService extends Infusionsoft_Service{
	public static function ping(Infusionsoft_App $app){
		return parent::ping($app, 'DataService');						
	}
	
	public static function load(Infusionsoft_App $app){
		
	}
	
	public static function findByField(Infusionsoft_App $app, $object, $field, $value, $limit = 1000, $page = 0, $returnFields = false){
		if(!$returnFields){	
			$returnFields = $object->getFields();
		}				
		var_dump($object->getTable());
		$params = array(
			$object->getTable(),
			$limit,
			$page,
			$field,
			$value,
			$returnFields
		);

		$records = $app->send('DataService.findByField', $params);		
		return self::_returnResults(get_class($object), $app->getHostName(), $records);
	}
}