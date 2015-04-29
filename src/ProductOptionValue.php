<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property Integer Id
 * @property Integer IsDefault
 * @property String Label
 * @property String Name
 * @property Integer OptionIndex
 * @property Double PriceAdjustment
 * @property Integer ProductOptionId
 * @property String Sku
 */
class ProductOptionValue extends Base {
    protected static $tableFields = array('Id', 'IsDefault', 'Label', 'Name', 'OptionIndex', 'PriceAdjustment', 'ProductOptionId', 'Sku');

    public function __construct($id = null, $app = null){
        parent::__construct('ProductOptValue', $id, $app);
    }
}