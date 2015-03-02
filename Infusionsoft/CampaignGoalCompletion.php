<?php
/**
 * Created by PhpStorm.
 * User: Erik
 * Date: 2/3/2015
 * Time: 2:09 PM
 */

class Infusionsoft_CampaignGoalCompletion  extends Infusionsoft_Generated_Base {
    protected static $tableFields = array(
        "Id",
        "ContactId",
        "ContactName",
        'GoalCompletionDate',
        'GoalName',
        'CampaignName'
    );

    public function __construct($idString = null, $app = null){
        $this->table = 'CampaignGoalCompletion';
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function save() {
        throw new Infusionsoft_Exception("CampaignGoalCompletion cannot be saved since they are loaded from a saved search, and not accessible via the Data Service");
    }

    public function loadFromArray($data){
        parent::loadFromArray($data, true);
        foreach($data as $key=>$value){
            if($key == 'funnel.goalachieved.goal.name'){
                $this->GoalName = $value;
            } elseif($key == 'funnel.goalachieved.funnel.name'){
                $this->CampaignName = $value;
            } elseif($key == 'funnel.goalachieved.date.achieved'){
                $this->GoalCompletionDate = $value;
            }
        }
        $this->Id = $data['ContactId'].'-'.$data['funnel.goalachieved.goal.name'].'-'.$data['funnel.goalachieved.date.achieved'];
    }
}