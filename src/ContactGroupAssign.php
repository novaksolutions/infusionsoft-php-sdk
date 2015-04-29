<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String GroupId
 * @property String ContactGroup
 * @property String DateCreated
 * @property String ContactId
 */
class ContactGroupAssign extends Base{
    protected static $tableFields = array('GroupId', 'ContactGroup', 'DateCreated', 'ContactId');

    public function __construct($id = null, $app = null){
        parent::__construct('ContactGroupAssign', $id, $app);
    }
}

