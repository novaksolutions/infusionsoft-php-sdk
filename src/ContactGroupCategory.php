<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String CategoryName
 * @property String CategoryDescription
 */
class ContactGroupCategory extends Base{
    protected static $tableFields = array('Id', 'CategoryName', 'CategoryDescription');

    public function __construct($id = null, $app = null){
        parent::__construct('ContactGroupCategory', $id, $app);
    }
}

