<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String OrderId
 * @property String ProductId
 * @property String SubscriptionPlanId
 * @property String ItemName
 * @property String Qty
 * @property String CPU
 * @property String PPU
 * @property String ItemDescription
 * @property String ItemType
 * @property String Notes
 */
class OrderItem extends Base{
    protected static $tableFields = array('Id', 'OrderId', 'ProductId', 'SubscriptionPlanId', 'ItemName', 'Qty', 'CPU', 'PPU', 'ItemDescription', 'ItemType', 'Notes');

    public function __construct($id = null, $app = null){
        parent::__construct('OrderItem', $id, $app);
    }
}

