<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String Name
 * @property String OwnerId
 */
class UserGroup extends Base{
    protected static $tableFields = array('Id', 'Name', 'OwnerId');

    public function __construct($id = null, $app = null){
        parent::__construct('UserGroup', $id, $app);
    }
}

