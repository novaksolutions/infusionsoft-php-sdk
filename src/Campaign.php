<?php
namespace NovakSolutions\Infusionsoft;
/**
* @property String Id
* @property String Name
* @property String Status
*/
class Campaign extends Base{
    protected static $tableFields = array('Id', 'Name', 'Status');

    public function __construct($id = null, $app = null){
        parent::__construct('Campaign', $id, $app);
    }

}

