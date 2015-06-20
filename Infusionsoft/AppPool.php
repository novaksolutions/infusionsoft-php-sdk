<?php
/**
 * Class Infusionsoft_AppPool
 */
class Infusionsoft_AppPool{
	static protected $apps = array();
	static protected $defaultTokenStorageProvider = null;

	public function __construct(){
	}

    /**
     * @param string $appHostname
     * @return Infusionsoft_App
     */

    public static function defaultAppHostname(){
        return self::$apps['default']->getHostname();
    }

    public static function getApp($appHostname = ''){
		$appKey = strtolower($appHostname);
		if($appKey == '') $appKey = 'default';				
		if(array_key_exists($appKey, self::$apps)){
			return self::$apps[$appKey];	
		} else{
			return null;
		}
	}

    /**
     * @param $app
     * @param null $appKey
     * @return Infusionsoft_App
     */
    public static function addApp(Infusionsoft_App $app, $appKey = null){
		if(count(self::$apps) == 0){
			self::$apps['default'] = $app;				
		}		
		if($appKey == null){
			$appKey = $app->getHostname();
		}		
		self::$apps[strtolower($appKey)] = $app;
        return $app;
	}

    public static function clearApps(){
        self::$apps = array();
    }

    /**
     * Add an Infusionsoft_App to the app pool (If necessary) and set it as the default app.
     * @param Infusionsoft_App $app
     * @param null $appKey
     * @return Infusionsoft_App The Infusionsoft_App added as the default
     */
    public static function setDefaultApp(Infusionsoft_App $app, $appKey = null) {
        $existingApp = self::getApp($app->getHostname());
        $app = ($existingApp == null) ? self::addApp($app, $appKey) : $existingApp;
        if (self::$apps['default'] != $app) {
            self::$apps['default'] = $app;
        }
        return self::$apps['default'];
    }

    public static function getDefaultStorageProvider(){
        if(static::$defaultTokenStorageProvider == null){
            static::$defaultTokenStorageProvider = new Infusionsoft_SimpleJsonFileTokenStorageProvider();
        }
        return static::$defaultTokenStorageProvider;
    }

    public static function setDefaultStorageProvider(Infusionsoft_TokenStorageProvider $storageProvider){
        static::$defaultTokenStorageProvider = $storageProvider;
    }
}