<?php
/**
 * @property int Id
 * @property int ProductId
 * @property String Cycle
 * @property int Frequency
 * @property float PreAuthorizeAmount
 * @property boolean Prorate
 * @property boolean Active
 * @property float PlanPrice
 * @property int NumberOfcycles
 */
class Infusionsoft_Generated_SubscriptionPlan extends Infusionsoft_Generated_Base{
    static $Cycle_WEEK  = 3;
    static $Cycle_MONTH = 2;
    static $Cycle_YEAR  = 1;
    static $Cycle_DAY   = 6;

    protected static $tableFields = array('Id', 'ProductId', 'Cycle', 'Frequency', 'PreAuthorizeAmount', 'Prorate', 'Active', 'PlanPrice', 'NumberOfCycles');

    public function __construct($id = null, $app = null){    	    	
    	parent::__construct('SubscriptionPlan', $id, $app);
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
