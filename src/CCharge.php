<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String RefNum
 * @property String ApprCode
 * @property String Amt
 * @property String CCId
 */
class CCharge extends Base{
    protected static $tableFields = array('Id', 'CCId', 'PaymentId', 'MerchantId', 'OrderNum', 'RefNum', 'ApprCode', 'Amt');

    public function __construct($id = null, $app = null){
        parent::__construct('CCharge', $id, $app);
    }
}

