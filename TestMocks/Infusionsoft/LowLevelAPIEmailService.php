<?php
class Infusionsoft_LowLevelAPIEmailService extends Infusionsoft_LowLevelMockService{

    public function addEmailTemplate($args){
        //Remove Api Key
        array_shift($args);
        throw new Exception("Not yet Implmented");
//        return $this->data->update($args);
    }
    public function attachEmail($args){
        //Remove Api Key
        array_shift($args);
        throw new Exception("Not yet Implmented");
//        return $this->data->update($args);
    }
    public function getEmailTemplate($args){
        //Remove Api Key
        array_shift($args);
        throw new Exception("Not yet Implmented");
//        return $this->data->update($args);
    }
    public function getOptStatus($args){
        //Remove Api Key
        array_shift($args);
        throw new Exception("Not yet Implmented");
//        return $this->data->update($args);
    }
    public function optIn($args){
        //Remove Api Key
        array_shift($args);
        list($email, $reason) = $args;
        return $this->data->optInEmail($email, $reason);
    }

    public function optOut($args){
        //Remove Api Key
        array_shift($args);
        list($email, $reason) = $args;
        return $this->data->optOutEmail($email, $reason);
    }

    public function sendEmail($args){
        //Remove Api Key
        array_shift($args);
        throw new Exception("Not yet Implmented");
//        return $this->data->update($args);
    }
    public function sendTemplate($args){
        //Remove Api Key
        array_shift($args);
        list($contactIds, $templateId) = $args;
        if(!isset($this->data->templatesSent[$templateId])){
            $this->data->templatesSent[$templateId] = array();
        }
        foreach($contactIds as $contactId){
            $this->data->templatesSent[$templateId][] = $contactId;
        }
    }

    public function updateEmailTemplate($args){
        //Remove Api Key
        array_shift($args);
        throw new Exception("Not yet Implmented");
//        return $this->data->update($args);
    }
}
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 3:11 AM
 * To change this template use File | Settings | File Templates.
 */