<?php
class Infusionsoft_Service{
	
	public static function ping($serviceName, Infusionsoft_App $app = null){	
		$app = self::getAppIfNull($app);	
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
        if(!$records){
            return array();
        }        
        
        if(!is_array($records)){
			$records = array($records);
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

    protected static function _returnResult($className, $appHostName, $records){    	    	
    	$object = new $className();    	        
        $object->loadFromArray($records);
        $object->setAppPoolAppKey($appHostName);        
        return $object;        	
    }
    
    protected static function getObjectOrDefaultAppIfNull(Infusionsoft_App $app = null, Infusionsoft_Generated_Base $object = null){
    	//If an app is explicitly set, skip this...
    	if($app == null){
    		//If the object has an app key, return it's app
	    	if($object != null && $object->getAppPoolAppKey() != null){			
				$app = Infusionsoft_AppPool::getApp($object->getAppPoolAppKey());
			}
			//Otherwise, return the default app.
			else{
	    		$app = Infusionsoft_AppPool::getApp();
			}	
    	}
    	return $app;
    }
    
	protected static function getAppIfNull(Infusionsoft_App $app = null){
    	if($app == null){
    		$app = Infusionsoft_AppPool::getApp();	
    	}
    	return $app;
    }
}