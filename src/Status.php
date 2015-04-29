<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String StatusName
 * @property String StatusOrder
 * @property String TargetNumDays
 */
class Status extends Base{
    protected static $tableFields = array('Id', 'StatusName', 'StatusOrder', 'TargetNumDays');

    public function __construct($id = null, $app = null){
        parent::__construct('Status', $id, $app);
    }
}

