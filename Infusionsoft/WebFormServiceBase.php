<?php
class Infusionsoft_WebFormServiceBase extends Infusionsoft_Service{

    public static function getMap(Infusionsoft_App $app = null){
        $params = array(
        );

        return parent::send($app, "WebFormService.getMap", $params);
    }
    
    public static function getHTML($webformId, Infusionsoft_App $app = null){
        $params = array(
            (int) $webformId
        );

        return parent::send($app, "WebFormService.getHTML", $params);
    }
    
}