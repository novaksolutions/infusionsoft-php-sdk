<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String InvoiceId
 * @property String Amt
 * @property String PayDate
 * @property String PayStatus
 * @property String PaymentId
 * @property String SkipCommission
 */
class InvoicePayment extends Generated_InvoicePayment{
    protected static $tableFields = array('Id', 'InvoiceId', 'Amt', 'PayDate', 'PayStatus', 'PaymentId', 'SkipCommission');

    public function __construct($id = null, $app = null){
        parent::__construct('InvoicePayment', $id, $app);
    }
}

