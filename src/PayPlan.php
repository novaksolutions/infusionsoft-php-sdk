<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String InvoiceId
 * @property String DateDue
 * @property String AmtDue
 * @property String Type
 * @property String InitDate
 * @property String StartDate
 * @property String FirstPayAmt
 */
class PayPlan extends Base{
    protected static $tableFields = array('Id', 'InvoiceId', 'DateDue', 'AmtDue', 'Type', 'InitDate', 'StartDate', 'FirstPayAmt');

    public function __construct($id = null, $app = null){
        parent::__construct('PayPlan', $id, $app);
    }
}

