<?php
class Infusionsoft_SmartCache{
    protected $ttl = 120;
    protected $name = '';
    protected $dir = '';

    public function __construct($name, $ttl = 300, $dir = 'cache'){
        if (strpos($dir, '/') !== 0 && strpos($dir, ':') !== 1){
            $dir = APP . 'Vendor' . DS . 'php-infusionsoft-sdk' . DS . 'Infusionsoft' . DS . $dir;
        }
        $this->ttl = $ttl;
        $this->dir = $dir;
        $this->name = $name;
    }

    public function getData(){
        $data = $this->getDataFromCacheIfNotStale();
        if($data === false){
            $data = $this->getDataFromSource();
            $this->cacheData($data);
        } else {
            unset($data['expiration']);
        }
        return $data;
    }

    public function getCacheFileName(){
        return $this->dir . '/' . $this->name . '.cache';
    }

    public function expireCache(){
        unlink($this->getCacheFileName());
    }

    public function getDataFromSource(){
        throw new Exception("Must Override This Method");
    }

    public function isDataNotStale($data){
        $isGood = true;
        //If this is expired, return false, or if the creation data (extrapolated by expiration time stamp minus ttl) is in the future).
        if($data['expiration'] < time() || $data['expiration'] - $this->ttl > time() || defined('INFUSIONSOFT_SDK_TEST')){
            $isGood = false;
        }
        return $isGood;
    }

    public function getDataFromCacheIfNotStale(){
        $data = $this->getDataFromCache();
        if($this->isDataNotStale($data)){
            return $data;
        } else {
            return false;
        }
    }

    public function getDataFromCache(){
        $data = false;
        if(file_exists($this->getCacheFileName())){
            $serialized_data = file_get_contents($this->getCacheFileName());
            $data = unserialize($serialized_data);
        }
        return $data;
    }

    public function cacheData($data){
        $fh = fopen($this->dir . "/" . $this->name . '.cache', 'w+');

	    $expiration = time() + $this->ttl;
	    $data['expiration'] = $expiration;

	    fwrite($fh, serialize($data));
	    fclose($fh);
    }
}