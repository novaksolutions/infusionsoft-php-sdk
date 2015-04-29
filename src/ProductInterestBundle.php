<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String BundleName
 * @property String Description
 */
class ProductInterestBundle extends Base{
    protected static $tableFields = array('Id', 'BundleName', 'Description');

    public function __construct($id = null, $app = null){
        parent::__construct('ProductInterestBundle', $id, $app);
    }
}

