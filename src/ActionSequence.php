<?php
namespace NovakSolutions\Infusionsoft;

/**
 * @property String Id
 * @property String TemplateName
 * @property String VisibleToTheseUsers
 */

class ActionSequence extends Base{
    protected static $tableFields = array('Id', 'TemplateName', 'VisibleToTheseUsers');

    public function __construct($id = null, $app = null){
        parent::__construct('ActionSequence', $id, $app);
    }
}



