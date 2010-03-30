<?php
class Infusionsoft_Service{
	
	public static function ping(Infusionsoft_App $app, $serviceName){		
		$out = false;
		try{
			$result = $app->sendWithoutAddingKey( $serviceName . '.echo', array('Hello World'), false);
			if($result) $out = true;			
		}		
		catch(Exception $e){			
			$out = FALSE;
		}		
		return $out;
	}
	
	protected static function _returnResults($className, $appHostName, $records){    	      
        if (!$records){
            return array();
        }        
        
        $return_records = array();                           
        foreach ($records as $record){        	
        	$object = new $className();        	
            $object->loadFromArray($record);
            $object->setAppPoolAppKey($appHostName);
            $return_records[] = $object;             
        }        
        
        return $return_records; 	
    }
    
    protected static function getDefaultAppIfNull($app){
    	if($app == null) $app = Infusionsoft_AppPool::getApp();
    	return $app;
    }
}