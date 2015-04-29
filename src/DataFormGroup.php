<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String TabId
 * @property String Name
 */
class DataFormGroup extends Base{
    protected static $tableFields = array('Id', 'TabId', 'Name');

    public function __construct($id = null, $app = null){
        parent::__construct('DataFormGroup', $id, $app);
    }
}

