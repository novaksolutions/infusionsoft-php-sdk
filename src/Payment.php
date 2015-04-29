<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String PayDate
 * @property String UserId
 * @property String PayAmt
 * @property String PayType
 * @property String ContactId
 * @property String PayNote
 * @property String InvoiceId
 * @property String RefundId
 * @property String ChargeId
 * @property String Commission
 * @property String Synced
 */
class Payment extends Base{
    protected static $tableFields = array('Id', 'PayDate', 'UserId', 'PayAmt', 'PayType', 'ContactId', 'PayNote', 'InvoiceId', 'RefundId', 'ChargeId', 'Commission', 'Synced');

    public function __construct($id = null, $app = null){
        parent::__construct('Payment', $id, $app);
    }
}

