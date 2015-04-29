<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ContactId
 * @property String JobId
 * @property String DateCreated
 * @property String InvoiceTotal
 * @property String TotalPaid
 * @property String TotalDue
 * @property String PayStatus
 * @property String CreditStatus
 * @property String RefundStatus
 * @property String PayPlanStatus
 * @property String AffiliateId
 * @property String LeadAffiliateId
 * @property String PromoCode
 * @property String InvoiceType
 * @property String Description
 * @property String ProductSold
 * @property String Synced
 */
class Invoice extends Base{
    protected static $tableFields = array('Id', 'ContactId', 'JobId', 'DateCreated', 'InvoiceTotal', 'TotalPaid', 'TotalDue', 'PayStatus', 'CreditStatus', 'RefundStatus', 'PayPlanStatus', 'AffiliateId', 'LeadAffiliateId', 'PromoCode', 'InvoiceType', 'Description', 'ProductSold', 'Synced');

    public function __construct($id = null, $app = null){
        parent::__construct('Invoice', $id, $app);
    }
}

