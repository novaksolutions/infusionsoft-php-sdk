<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String FormId
 * @property String TabName
 */
class DataFormTab extends Base{
    protected static $tableFields = array('Id', 'FormId', 'TabName');

    public function __construct($id = null, $app = null){
        parent::__construct('DataFormTab', $id, $app);
    }
}

