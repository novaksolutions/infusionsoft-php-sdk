<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String FileName
 * @property String Extension
 * @property String FileSize
 * @property String ContactId
 * @property String Public
 */
class FileBox extends Base{
    protected static $tableFields = array('Id', 'FileName', 'Extension', 'FileSize', 'ContactId', 'Public');

    public function __construct($id = null, $app = null){
        parent::__construct('FileBox', $id, $app);
    }
}

