<?php
class Infusionsoft_DataService extends Infusionsoft_Service{
	public static function ping(Infusionsoft_App $app){
		return parent::ping($app, 'DataService');						
	}
	
	public static function addCustomField(Infusionsoft_Generated_Base &$object, $displayName, $dataType, $groupId, $id, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);
		
		$params = array(
			$object->getTable(),
			$displayName,
			$dataType,
			(int) $groupId,
			(int) $object->Id
		);

		$customFieldId = $app->send('DataService.addCustomField', $params);
		return $customFieldId;	
	}
	
	public static function delete(Infusionsoft_Generated_Base &$object, $id, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);
		
		$params = array(
			$object->getTable(),
			(int) $object->Id
		);

		$records = $app->send('DataService.delete', $params);		
	}
	
	public static function findByField($object, $field, $value, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null){		
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);
		
		if(!$returnFields){	
			$returnFields = $object->getFields();
		}						
		
		$params = array(
			$object->getTable(),
			(int) $limit,
			(int) $page,
			$field,
			$value,
			$returnFields
		);

		$records = $app->send('DataService.findByField', $params);		
		return self::_returnResults(get_class($object), $app->getHostName(), $records);
	}
	
	public static function getAppointmentICal($appointmentId, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);					
		
		$params = array(
		(int) $appointmentId);
		
		$out = $app->send('DataService.getAppointmentICal', $params);					

		return $out;	
	}
	
	public static function getAppSetting($moduleName, $settingName, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app);					
		
		$params = array(
		$moduleName,
		$settingName);
		
		$out = $app->send('DataService.getAppSetting', $params);					

		return $out;	
	}	
	/*
	 * This is in the DataService.java file, but not exposed...
	public static function getMetaData(Infusionsoft_Generated_Base &$object, Infusionsoft_App $app = null){	
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);					
		
		$params = array(
		$object->getTable());
		
		$arrayOfFields = $app->send('DataService.getMetaData', $params);					

		return $arrayOfFields;	
	}
	*/
	
	public static function load(Infusionsoft_Generated_Base &$object, $id, $returnFields = false, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);
		
		if(!$returnFields){	
			$returnFields = $object->getFields();
		}						
		
		$params = array(
			$object->getTable(),
			(int) $id,
			$returnFields
		);

		$records = $app->send('DataService.load', $params);		
		return self::_returnResults(get_class($object), $app->getHostName(), $records);
	}
	
	public static function query($object, $queryData, $limit = 1000, $page = 0, $returnFields = false, Infisionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);
		
		if(!$returnFields){	
			$returnFields = $object->getFields();
		}						
		
		$params = array(
			$object->getTable(),
			(int) $limit,
			(int) $page,
			$queryData,
			$returnFields
		);

		$records = $app->send('DataService.query', $params);		
		return self::_returnResults(get_class($object), $app->getHostName(), $records);		
	}
	
	public static function queryWithOrderBy($object, $queryData, $orderByField, $ascending = true, $limit = 1000, $page = 0, $returnFields = false, Infisionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);
		
		if(!$returnFields){	
			$returnFields = $object->getFields();
		}						
		
		if(is_bool($ascending)){
			$ascending = $ascending && true;
		}
		
		$params = array(
			$object->getTable(),
			(int) $limit,
			(int) $page,
			$queryData,
			$returnFields,
			$orderByField,
			(bool) $ascending
		);

		$records = $app->send('DataService.query', $params);		
		return self::_returnResults(get_class($object), $app->getHostName(), $records);		
	}		
	
	public static function save(Infusionsoft_Generated_Base &$object, Infusionsoft_App $app = null){		
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);			
		
		$out = 0;

		if ($object->isEmpty()){
			throw new Infusionsoft_Exception(sprintf('Cannot save a blank %s record', $object->getTable()));
		}
		
		if($object->Id > 0){			
			$params = array(
			$object->getTable(),
			(int) $object->Id,
			$object->toArray());
			$out = $app->send('DataService.update', $params);			
		}
		else{
			$params = array(
			$object->getTable(),
			$object->toArray());
			$object->Id = $app->send('DataService.add', $params);
			$out = $object->Id; 
		}

		return $out;	
	}	

	public static function updateCustomField($customFieldId, $arrayOfValues, Infusionsoft_App $app = null){
		$app = parent::getObjectOrDefaultAppIfNull($app, $object);					
		
		$params = array(
		(int) $customFieldId,
		$arrayOfValues);
		$out = $app->send('DataService.updateCustomField', $params);					

		return $out;	
	}
}