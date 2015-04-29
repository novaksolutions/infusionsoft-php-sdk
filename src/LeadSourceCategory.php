<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String Name
 * @property String Description
 */
class LeadSourceCategory extends Base {
    protected static $tableFields = array('Id', 'Name', 'Description');

    public function __construct($id = null, $app = null){
        parent::__construct('LeadSourceCategory', $id, $app);
    }
}

