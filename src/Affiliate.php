<?php
namespace NovakSolutions\Infusionsoft;

/**
 * @property String Id
 * @property String ContactId
 * @property String ParentId
 * @property String LeadAmt
 * @property String LeadPercent
 * @property String SaleAmt
 * @property String SalePercent
 * @property String PayoutType
 * @property String DefCommissionType
 * @property String Status
 * @property String AffName
 * @property String Password
 * @property String AffCode
 * @property String NotifyLead
 * @property String NotifySale
 * @property String LeadCookieFor
 */
class Affiliate extends BaseWithCustomFields{
    protected static $tableFields = array('Id', 'ContactId', 'ParentId', 'LeadAmt', 'LeadPercent', 'SaleAmt', 'SalePercent', 'PayoutType', 'DefCommissionType', 'Status', 'AffName', 'Password', 'AffCode', 'NotifyLead', 'NotifySale', 'LeadCookieFor');
    const CUSTOM_FIELD_FORM_ID = -3;

    public function __construct($id = null, $app = null){
        parent::__construct('Affiliate', $id, $app);
    }
}

