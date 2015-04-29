<?php
namespace NovakSolutions\Infusionsoft;

class PhoneContact extends Base{
    protected static $tableFields = array('Id', 'LastUpdated', 'Phone1', 'Phone1Ext', 'Phone1Type', 'Phone2', 'Phone2Ext', 'Phone2Type', 'Phone3', 'Phone3Ext', 'Phone3Type', 'Phone4', 'Phone4Ext', 'Phone4Type', 'Phone5', 'Phone5Ext', 'Phone5Type');

    public function __construct($id = null, $app = null){
        parent::__construct('Contact', $id, $app);
    }
}

