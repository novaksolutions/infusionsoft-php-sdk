<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ContactId
 * @property String ExpenseType
 * @property String TypeId
 * @property String ExpenseAmt
 * @property String DateIncurred
 */
class Expense extends Base{
    protected static $tableFields = array('Id', 'ContactId', 'ExpenseType', 'TypeId', 'ExpenseAmt', 'DateIncurred');

    public function __construct($id = null, $app = null){
        parent::__construct('Expense', $id, $app);
    }
}

