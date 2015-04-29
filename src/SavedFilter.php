<?php
/**
 * @property String Id
 * @property String FilterName
 * @property String ReportStoredName
 * @property String UserId
 */
class SavedFilter extends Base{
    protected static $tableFields = array('Id', 'FilterName', 'ReportStoredName', 'UserId');

    public function __construct($id = null, $app = null){
        parent::__construct('SavedFilter', $id, $app);
    }
}

