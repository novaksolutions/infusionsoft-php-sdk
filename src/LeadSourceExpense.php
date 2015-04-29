<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String LeadSourceRecurringExpenseId
 * @property String LeadSourceId
 * @property String Title
 * @property String Notes
 * @property String Amount
 * @property String DateIncurred
 */
class LeadSourceExpense extends Base {
    protected static $tableFields = array('Id', 'LeadSourceRecurringExpenseId', 'LeadSourceId', 'Title', 'Notes', 'Amount', 'DateIncurred');

    public function __construct($id = null, $app = null){
        parent::__construct('LeadSourceExpense', $id, $app);
    }
}

