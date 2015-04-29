<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String OpportunityTitle
 * @property String ContactID
 * @property String AffiliateId
 * @property String UserID
 * @property String StageID
 * @property String StatusID
 * @property String Leadsource
 * @property String Objection
 * @property String ProjectedRevenueLow
 * @property String ProjectedRevenueHigh
 * @property String OpportunityNotes
 * @property String DateCreated
 * @property String LastUpdated
 * @property String LastUpdatedBy
 * @property String CreatedBy
 */
class Lead extends BaseWithCustomFields{
    protected static $tableFields = array('Id', 'OpportunityTitle', 'ContactID', 'AffiliateId', 'UserID', 'StageID', 'StatusID', 'Leadsource', 'Objection', 'ProjectedRevenueLow', 'ProjectedRevenueHigh', 'OpportunityNotes', 'DateCreated', 'LastUpdated', 'LastUpdatedBy', 'CreatedBy', 'EstimatedCloseDate', 'NextActionDate', 'NextActionNotes');
    var $customFieldFormId = -4;

    public function __construct($id = null, $app = null){
        parent::__construct('Lead', $id, $app);
    }
}

