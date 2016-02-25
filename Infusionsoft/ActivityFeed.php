<?php
/**
 * Created by PhpStorm.
 * User: Keith
 * Date: 4/30/14
 * Time: 1:26 PM
 */

class Infusionsoft_ActivityFeed  extends Infusionsoft_Generated_Base {
    protected static $tableFields = array(
        "Id",
        "Name",
        "Description",
        "Email",
        "Date",
        "ContactId",
        "Fullname",
        "Firstname",
        "Lastname",
        "Phone",
        "Fax",
        "Type",
        "NSLinkClicked",
        "NSBatchId",
        "NSEmailSentId",
        "NSLinkClicked",
        "NSEmailTitle",
        "NSPostProcessed"
    );

    public function __construct($idString = null, $app = null){
        $this->table = 'ActivityFeed';
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function save() {
        throw new Infusionsoft_Exception("ActivityFeed cannot be saved since they are loaded from a saved search, and not accessible via the Data Service");
    }

    public function loadFromArray($data){
        parent::loadFromArray($data, true);
        $this->Id = $data['ContactId'] * 100000000000 + $this->actionToId($data['Type']) * 10000000000 + strtotime($data['Date']);
    }

    public function actionToId($actionName){
        switch($actionName){
            case "EmailOpen":
                return 1;
            case "EmailClick":
                return 2;
            case "WebFormSubmission":
                return 3;
            default:
                return 4;
        }
    }
}