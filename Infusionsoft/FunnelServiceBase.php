<?php
class Infusionsoft_FunnelServiceBase extends Infusionsoft_Service {

    public static function achieveGoal($integration, $callName, $contactId = 0, Infusionsoft_App $app = null){
        $params = array(
            $integration,
            $callName,
            (int) $contactId
        );

        return parent::send($app, "FunnelService.achieveGoal", $params);
    }

}