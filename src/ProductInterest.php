<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ObjectId
 * @property String ObjType
 * @property String ProductId
 * @property String ProductType
 * @property String Qty
 * @property String DiscountPercent
 */
class ProductInterest extends Base{
    protected static $tableFields = array('Id', 'ObjectId', 'ObjType', 'ProductId', 'ProductType', 'Qty', 'DiscountPercent');


    public function __construct($id = null, $app = null){
        parent::__construct('ProductInterest', $id, $app);
    }
}

