<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Joey
 * Date: 2/16/12
 * Time: 2:25 PM
 * To change this template use File | Settings | File Templates.
 */
define('INFUSIONSOFT_REMOVE_FIELDS_URL', 'https://d3rof4a8ql225j.cloudfront.net/hosted/php-infusionsoft-sdk/0.9.14_remove_fields.txt');

class Infusionsoft_RemoveFieldsCache extends Infusionsoft_SmartCache{
    public function __construct(){
        parent::__construct('remove_fields', 60*60*12, dirname(__FILE__) . '/cache/');
    }

    public function getDataFromSource(){
        $data = false;
        $ch = curl_init(INFUSIONSOFT_REMOVE_FIELDS_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        $content = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($httpCode == 200){
            try{
                $data = unserialize($content);
            } catch(Exception $e){
                $data = false;
            }
        }
        return $data;
    }

    //We overide this, because if the cache is stale, and we can't get new data, we want the most recent.
    public function getData(){
        $data = $this->getDataFromCache();

        if($this->isDataNotStale($data)){
        } else {
            $newData = $this->getDataFromSource();
            if($newData !== false){
                $data = $newData;
                try{
                    $this->cacheData($data);
                } catch(Exception $e){
                    //Directory Probably not writeable...
                }

            }
        }

        if(!empty($data['expiration'])) unset($data['expiration']);

        return $data;
    }
}
