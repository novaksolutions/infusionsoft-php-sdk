<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String InvoiceId
 * @property String OrderItemId
 * @property String InvoiceAmt
 * @property String Discount
 * @property String DateCreated
 * @property String Description
 * @property String CommissionStatus
 */
class InvoiceItem extends Base{
    protected static $tableFields = array('Id', 'InvoiceId', 'OrderItemId', 'InvoiceAmt', 'Discount', 'DateCreated', 'Description', 'CommissionStatus');

    public function __construct($id = null, $app = null){
        parent::__construct('InvoiceItem', $id, $app);
    }
}

