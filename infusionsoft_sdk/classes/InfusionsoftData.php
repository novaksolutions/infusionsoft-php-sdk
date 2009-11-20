<?php

class InfusionsoftData extends InfusionsoftBaseDataObject {    
    public function __construct($table, $initial_data){
    	$this->_table = $table;
    	$this->_load_rpc_method = 'DataService.load';   	             
        if ($initial_data){
            $this->_reset_fields($initial_data);
        }
        
    }
             
    public function save(){  
    	$daoClassName = get_class($this) . 'DAO'; 
    	$DAO = new $daoClassName();   	
    	return $DAO->save($this);
    }       
}