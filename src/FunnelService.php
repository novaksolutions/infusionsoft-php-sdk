<?php
namespace NovakSolutions\Infusionsoft;

class FunnelService extends Service{

    public static function achieveGoal($integration, $callName, $contactId = 0, App $app = null){
        $params = array(
            $integration,
            $callName,
            (int) $contactId
        );

        return parent::send($app, "FunnelService.achieveGoal", $params);
    }
}