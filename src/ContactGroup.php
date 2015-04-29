<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String GroupName
 * @property String GroupCategoryId
 * @property String GroupDescription
 */
class ContactGroup extends Base{
    protected static $tableFields = array('Id', 'GroupName', 'GroupCategoryId', 'GroupDescription');

    public function __construct($id = null, $app = null){
        parent::__construct('ContactGroup', $id, $app);
    }
}

