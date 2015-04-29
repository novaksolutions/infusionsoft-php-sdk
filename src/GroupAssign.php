<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String UserId
 * @property String GroupId
 * @property String Admin
 */
class GroupAssign extends Generated_GroupAssign{
    protected static $tableFields = array('Id', 'UserId', 'GroupId', 'Admin');

    public function __construct($id = null, $app = null){
        parent::__construct('GroupAssign', $id, $app);
    }
}

