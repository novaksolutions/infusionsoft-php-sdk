<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 3/31/14
 * Time: 8:04 AM
 */

class Infusionsoft_EmailBroadcast  extends Infusionsoft_Generated_Base {
    protected static $tableFields = array(
        "Id",
        "Name",
        "MailBatchId",
        "BatchSubject",
        "SentBy",
        "FollowUpSequence",
        "Subject",
        "Template",
        "Status",
        "Total",
        "Done",
        "Skip",
        "BatchStartDate",
        "BatchTemplate",
        "BatchStatus",
        "FollowUpSequenceId",
        "EmailSubject",
        "EmailTitle",
        "Sender",
        "EmailsPerSecond"
    );

    public function __construct($idString = null, $app = null){
        $this->table = 'EmailBroadcast';
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function save() {
        throw new Infusionsoft_Exception("EmailBroadcast cannot be saved since they are loaded from a saved search, and not accessible via the Data Service");
    }

    public function loadFromArray($data){
        parent::loadFromArray($data, true);
        $this->Id = $data['MailBatchId'];
    }
} 