<?php
/**
 * @property String Id
 * @property String LeadSourceRecurringExpenseId
 * @property String LeadSourceId
 * @property String Title
 * @property String Notes
 * @property String Amount
 * @property String DateIncurred
 */
class Infusionsoft_Generated_LeadSourceExpense extends Infusionsoft_Generated_Base {
    protected static $tableFields = array('Id', 'LeadSourceRecurringExpenseId', 'LeadSourceId', 'Title', 'Notes', 'Amount', 'DateIncurred');

    public function __construct($id = null, $app = null){
        parent::__construct('LeadSourceExpense', $id, $app);
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function addCustomField($name){
        self::$tableFields[] = $name;
    }

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }
}
