<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ProductId
 * @property String ProductCategoryId
 */
class ProductCategoryAssign extends Base{
    protected static $tableFields = array('Id', 'ProductId', 'ProductCategoryId');

    public function __construct($id = null, $app = null){
        parent::__construct('ProductCategoryAssign', $id, $app);
    }
}

