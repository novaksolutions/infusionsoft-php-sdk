<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String StageName
 * @property String StageOrder
 * @property String TargetNumDays
 */
class Stage extends Base{
    protected static $tableFields = array('Id', 'StageName', 'StageOrder', 'TargetNumDays');

    public function __construct($id = null, $app = null){
        parent::__construct('Stage', $id, $app);
    }
}

