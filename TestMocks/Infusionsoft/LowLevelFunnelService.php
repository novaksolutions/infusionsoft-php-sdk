<?php
class Infusionsoft_LowLevelFunnelService extends Infusionsoft_LowLevelMockService{

    public function achieveGoal($args){
        list($apiKey, $integrationName, $method, $contactId) = $args;
        $this->data->achieveGoal($integrationName, $method, $contactId);
        return true;
    }
}
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 3:11 AM
 * To change this template use File | Settings | File Templates.
 */