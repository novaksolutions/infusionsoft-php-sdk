<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String LeadSourceId
 * @property String Title
 * @property String Notes
 * @property String Amount
 * @property String StartDate
 * @property String EndDate
 * @property String NextExpenseDate
 */
class LeadSourceRecurringExpense extends Generated_LeadSourceRecurringExpense {
    protected static $tableFields = array('Id', 'LeadSourceId', 'Title', 'Notes', 'Amount', 'StartDate', 'EndDate', 'NextExpenseDate');

    public function __construct($id = null, $app = null){
        parent::__construct('LeadSourceRecurringExpense', $id, $app);
    }
}

