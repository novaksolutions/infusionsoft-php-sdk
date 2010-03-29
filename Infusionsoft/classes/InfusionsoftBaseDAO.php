<?php
class InfusionsoftBaseDAO{
	protected $_app;
	
	public function __construct($table, $objectName){
		$this->_objectName = $objectName;		
        $this->_load_rpc_method = 'DataService.load';
    	$this->_table = $table;         	   
        if (!$GLOBALS['InfusionsoftApp']->table_exists($table)){
            throw new InfusionsoftException('Unknown table');
        }
	}
	
	protected function _getFieldsToReturn($returnFields){
    	$fields = $GLOBALS['InfusionsoftApp']->fields[$this->_table];
    	if($returnFields !== false && is_array($returnFields)){
			$fields = $returnFields;    		
    	}	
    	return $fields;
    }
        
}