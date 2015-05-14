<?php
namespace NovakSolutions\Infusionsoft;
/**
 * Class AppPool
 */
class AppPool{
	static protected $apps = array();
	static private $defaultTokenStorageProvider = null;

	public function __construct(){

	}

    /**
     * @param string $appHostname
     * @return App
     */

    public static function defaultAppHostname(){
        return self::$apps['default']->getHostname();
    }

    /**
     * @param string $appHostname
     * @return App
     */
    public static function getApp($appHostname = ''){
		$appKey = strtolower($appHostname);
		if($appKey == '') $appKey = 'default';				
		if(array_key_exists($appKey, self::$apps)){
			return self::$apps[$appKey];	
		} else{
			return new App($appHostname);
		}
	}

    /**
     * @param $app
     * @param null $appKey
     * @return App
     */
    public static function addApp(App $app, $appKey = null){
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
     * Add an App to the app pool (If necessary) and set it as the default app.
     * @param App $app
     * @param null $appKey
     * @return App The App added as the default
     */
    public static function setDefaultApp(App $app, $appKey = null) {
        $existingApp = self::getApp($app->getHostname());
        $app = ($existingApp == null) ? self::addApp($app, $appKey) : $existingApp;
        if (self::$apps['default'] != $app) {
            self::$apps['default'] = $app;
        }
        return self::$apps['default'];
    }

    public static function getDefaultStorageProvider(){
        if(static::$defaultTokenStorageProvider == null){
            static::$defaultTokenStorageProvider = new Providers\SimpleJsonFileTokenStorage();
        }
        return static::$defaultTokenStorageProvider;
    }

    public static function setDefaultStorageProvider(Providers\TokenStorageProvider $storageProvider){
        static::$defaultTokenStorageProvider = $storageProvider;
    }
}