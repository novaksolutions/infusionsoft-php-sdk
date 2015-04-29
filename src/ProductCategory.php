<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String CategoryDisplayName
 * @property String CategoryOrder
 * @property String ParentId
 */
class ProductCategory extends Base{
    protected static $tableFields = array('Id', 'CategoryDisplayName', 'CategoryOrder', 'ParentId');
    //Other field is CategoryImage

    public function __construct($id = null, $app = null){
        parent::__construct('ProductCategory', $id, $app);
    }
}

