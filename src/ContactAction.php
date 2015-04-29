<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ContactId
 * @property String OpportunityId
 * @property String ActionType
 * @property String ActionDescription
 * @property String CreationDate
 * @property String CreationNotes
 * @property String CompletionDate
 * @property String ActionDate
 * @property String EndDate
 * @property String PopupDate
 * @property String UserID
 * @property String Accepted
 * @property String CreatedBy
 * @property String LastUpdated
 * @property String LastUpdatedBy
 * @property String Priority
 * @property String IsAppointment
 */
class ContactAction extends BaseWithCustomFields{
    protected static $tableFields = array('Id', 'ContactId', 'OpportunityId', 'ActionType', 'ActionDescription', 'CreationDate', 'CreationNotes', 'CompletionDate', 'ActionDate', 'EndDate', 'PopupDate', 'UserID', 'Accepted', 'CreatedBy', 'LastUpdated', 'LastUpdatedBy', 'Priority', 'IsAppointment');
    const CUSTOM_FIELD_FORM_ID = -5;

    public function __construct($id = null, $app = null){
        parent::__construct('ContactAction', $id, $app);
    }
}

