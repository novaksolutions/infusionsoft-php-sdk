<?php
namespace NovakSolutions\Infusionsoft;

class ActivityFeed extends Base {
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

    public function save() {
        throw new Exception("ActivityFeed cannot be saved since they are loaded from a saved search, and not accessible via the Data Service");
    }

    public function loadFromArray($data){
        parent::loadFromArray($data, true);
        $this->Id = $data['Date'] . '-' . $data['ContactId'];
    }
}