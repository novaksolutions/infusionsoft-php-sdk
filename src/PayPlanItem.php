<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String PayPlanId
 * @property String DateDue
 * @property String AmtDue
 * @property String Status
 * @property String AmtPaid
 */
class PayPlanItem extends Base{
    protected static $tableFields = array('Id', 'PayPlanId', 'DateDue', 'AmtDue', 'Status', 'AmtPaid');

    public function __construct($id = null, $app = null){
        parent::__construct('PayPlanItem', $id, $app);
    }
}

