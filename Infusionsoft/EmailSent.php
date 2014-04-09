<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 3/31/14
 * Time: 8:04 AM
 */

class Infusionsoft_EmailSent  extends Infusionsoft_Generated_Base {
    protected static $tableFields = array(
        "Id",
        "ContactId",
        "FirstName",
        "LastName",
        "Email",
        "BatchId",
        "Sent",
        "BounceType",
        "Bounced",
        "Opened",
        "Clicked",
        "LinkClickedId",
        "LinkClicked",
        "Opted",
        "OptType",
        "OptNotes"
    );

    public function __construct($idString = null, $app = null){
        $this->table = 'EmailSent';
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function save() {
        throw new Infusionsoft_Exception("EmailSent cannot be saved since they are loaded from a saved search, and not accessible via the Data Service");
    }

    public function loadFromArray($data){
        parent::loadFromArray($data, true);
        $this->Id = $data['EmailSentId'];
    }
} 