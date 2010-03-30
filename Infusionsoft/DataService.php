<?php
class Infusionsoft_DataService extends Infusionsoft_Service{
	public static function ping(Infusionsoft_App $app){
		return parent::ping($app, 'DataService');						
	}
	
	public static function load(Infusionsoft_Generated_Base &$object, $id, Infusionsoft_App $app = null){
		$app = parent::getDefaultAppIfNull($app);
		
		$out = null;
				
		
		$objects = self::findByField($object, 'Id', $id, 1, 0, false, $app);
		
		if(count($objects) == 1){			
			$object->loadFromObject($objects[0]);
		}	
	}
	
	public static function findByField($object, $field, $value, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null){
		$app = parent::getDefaultAppIfNull($app);
		
		if(!$returnFields){	
			$returnFields = $object->getFields();
		}						
		
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
	
	public static function save(Infusionsoft_Generated_Base $object, Infusionsoft_App $app = null){
		$app = parent::getDefaultAppIfNull($app);
		
		if($object->getAppPoolAppKey() != null){			
			$app = Infusionsoft_AppPool::getApp($object->getAppPoolAppKey());
		}
		
		$out = 0;

		if ($object->isEmpty()){
			throw new Infusionsoft_Exception(sprintf('Cannot save a blank %s record', $object->getTable()));
		}
		
		if($object->Id > 0){			
			$params = array(
			$object->getTable(),
			$object->Id + 0,
			$object->toArray());
			$out = $app->send('DataService.update', $params);			
		}
		else{
			$params = array(
			$object->getTable(),
			$object->toArray());
			$data->Id = $app->send('DataService.add', $params);
		}

		return $out;	
	}	
	 
	public function query($query, $returnFields = false, $limit = 1000, $page = 0, Infusionsoft_App $app = null){
		$fieldsToReturn = $this->_getFieldsToReturn($returnFields);
		$params = array($GLOBALS['InfusionsoftApp']->api_key,
		$this->_table,
		$limit,
		$page,
		$query,
		$fieldsToReturn);

		$records = $GLOBALS['InfusionsoftApp']->send('DataService.query', $params);
		return $this->_returnResults($records);
	}
	
	public function getOneByField($field, $value, $returnFields = false, Infusionsoft_App $app = null){
		$results = $this->getByField($field, $value, $resturnFields);		
		if(count($results) > 0){
			return $results[0];
		}
		else{
			return null;
		}
	}
}