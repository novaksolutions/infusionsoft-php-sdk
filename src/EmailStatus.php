<?php
namespace NovakSolutions\Infusionsoft;

class EmailStatus  extends Generated_Base {
    protected static $tableFields = array(
        "Id",
        "ContactId",
        "Name",
        "DateCreated",
        "Status",
        "OptType"
    );

    public function __construct($idString = null, $app = null){
        $this->table = 'EmailStatus';
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function save() {
        throw new Exception("EmailStatus cannot be saved since they are loaded from a saved search, and not accessible via the Data Service");
    }

    public function loadFromArray($data){
        parent::loadFromArray($data, true);
        $this->Id = $data['Id'];
    }
}