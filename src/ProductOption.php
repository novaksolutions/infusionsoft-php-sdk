<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property Integer Id
 * @property Integer ProductId
 * @property Integer AllowSpaces
 * @property String CanContain
 * @property Integer CanEndWith
 * @property String CanStartWith
 * @property Integer IsRequired
 * @property String Label
 * @property Integer MaxChars
 * @property Integer MinChars
 * @property String Name
 * @property String OptionType
 * @property Integer Order
 * @property String TextMessage
 */
class ProductOption extends Generated_ProductOption {
    protected static $tableFields = array('Id', 'ProductId', 'AllowSpaces', 'CanContain', 'CanEndWith', 'CanStartWith', 'IsRequired', 'Label', 'MaxChars', 'MinChars', 'Name', 'OptionType', 'Order', 'TextMessage');

    public function __construct($id = null, $app = null){
        parent::__construct('ProductOption', $id, $app);
    }
}

