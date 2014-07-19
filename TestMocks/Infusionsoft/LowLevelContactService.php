<?php
class Infusionsoft_LowLevelContactService extends Infusionsoft_LowLevelMockService{

    public function add($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }


    public function addToCampaign($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function addToGroup($args){
        array_shift($args);
        $contactId = array_shift($args);
        $groupId = array_shift($args);
        $this->data->add(array('ContactGroupAssign', array('GroupId' => $groupId, 'ContactId' => $contactId)));
        $contact = $this->data->getObjectById('Contact', $contactId);
        $groups = explode(",", isset($contact['Groups']) ? $contact['Groups'] : '');
        $groups[] = $groupId;
        $contact['Groups'] = implode(",", $groups);
        $this->data->update(array('Contact', $contact['Id'], $contact), true);
    }

    public function findByEmail($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function load($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function merge($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function getNextCampaignStep($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function pauseCampaign($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function removeFromCampaign($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function removeFromGroup($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function runActionSequence($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function resumeCampaignForContact($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function rescheduleCampaignStep($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

    public function addWithDupCheck($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }


    public function update($args){
        array_shift($args);
        throw new Exception("Not yet Implmented");
        //return $this->data->update($args);
    }

}
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 3:11 AM
 * To change this template use File | Settings | File Templates.
 */