<?php

class Infusionsoft_DataServiceObject {    
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
    
    protected $_infusionsoft_app;
    protected $_table;
    protected $_rpc_method = '';

    public function __toString() {
        
        if ($this->Id)
        {
            $return = sprintf("%s #%d", $this->_table, $this->Id); 
        }
        else
        {
            $return = sprintf('Unsaved $s', $this->_table);
        }
        
        return $return;
    }
    
    protected function _reset_fields($data = FALSE)
    {    	
        if (!isset($GLOBALS['InfusionsoftApp']->fields[$this->_table]))
        {
        	
            throw new InfusionsoftException(sprintf("Unknown table: %s", $this->_table));
        }
        
        foreach ($GLOBALS['InfusionsoftApp']->fields[$this->_table] as $field)
        {
            $this->$field = NULL;
            
            if ($data && is_object($data) && isset($data->$field))
            {
                $this->$field = $data->$field;
            }
            elseif ($data && is_array($data) && isset($data[$field]))
            {
                $this->$field = $data[$field];
            }
        }
    }
    
    public function load($id){
        if (!is_numeric($id))
        {
            throw InfusionsoftException('Id value must be numeric');
        }
        
        $params = array($this->_table,
                        intval($id),
                        $GLOBALS['InfusionsoftApp']->fields[$this->_table]);
                    
        $data = $GLOBALS['InfusionsoftApp']->send($this->_load_rpc_method, $params);
        
        $this->_reset_fields($data);

    }
    
    /**
     * Returns an associative array of all the field data
     *
     * @return array
     * @author Jon Gales
     */
    public function toArray()
    {
        $fields = array();        
        foreach ($GLOBALS['InfusionsoftApp']->fields[$this->_table] as $field)
        {
            $fields[$field] = $this->$field;
        }        
        return $fields;
    }   

	public function fields_are_blank($fields){
	    $blank = TRUE;
        
        foreach ($fields as $name => $val)
        {
            if ($val)
            {
                $blank = FALSE;
            }
        }
        
        return $blank;
	}
}