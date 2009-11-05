<?php

/**
 * Wrapper around DataService class of Infusionsoft API
 *
 * @author Jon Gales
 */
class Infusion_Data extends InfusionBaseChild {
    
    public function __construct($controller, $table, $initial_data)
    {
        $this->_controller = $controller;
        $this->_table = $table;
        
        if ($initial_data)
        {
            $this->_reset_fields($initial_data);
        }
    }
    
    public function load($id)
    {
        if (!isset($this->_controller->fields[$this->_table]))
        {
            throw Infusion_Exception('Unknown table');
        }
        
        if (!is_numeric($id))
        {
            throw Infusion_Exception('Id value must be numeric');
        }
        
        $params = array($this->_controller->api_key,
                        $this->_table,
                        intval($id),
                        $this->_controller->fields[$this->_table]);
                    
        $data = $this->_controller->send('DataService.load', $params);
        
        $this->_reset_fields($data);

    }
    
    /**
     * Adds or updates a record for the current table
     *
     * @return int
     * @author Jon Gales
     */
    public function save()
    {
        if ($this->Id)
        {
            $params = array($this->_controller->api_key,
                            $this->_table,
                            $this->Id,
                            $this->fields());
            return $this->_controller->send('DataService.update', $params);
        }
        
        if ($this->_controller->fields_are_blank($this->fields()))
        {
            throw new InfusionException(sprintf('Cannot save a blank %s record', $this->_table));
        }
        
        $params = array($this->_controller->api_key,
                        $this->_table,
                        $this->fields());
            
        $this->Id = $this->_controller->send('DataService.add', $params);
        
        return $this->Id;

    }
    
    /**
     * Searches the table for a specified column and value. Returns an array 
     * of Data objects
     *
     * @param string $field 
     * @param string $value 
     * @param int $limit 
     * @param int $page 
     * @return array of objects
     * @author Jon Gales
     */
    public function find_by_field($field, $value, $limit = 1000, $page = 0)
    {
        $params = array($this->_controller->api_key,
                        $this->_table,
                        $limit,
                        $page,
                        $field,
                        $value,
                        $this->_controller->fields[$this->_table]);
                        
        $records = $this->_controller->send('DataService.findByField', $params);
        
        if (!$records)
        {
            return array();
        }
        
        $return_records = array();
        
        foreach ($records as $record)
        {
            $return_records[] = $this->_controller->Data($this->_table, $record);
        }
        
        return $return_records;        

    }
    
    public function authenticate_user($value='')
    {
        # todo
    }
    
    /**
     * Queries the table for the supplied key/value pairs in $query.
     * % is wildcard.
     * 
     * Give query options like so: $query = array('key'=>'value');
     *
     * Returns an array of Data objects
     * 
     * @param array $query 
     * @param int $limit 
     * @param int $page 
     * @return array of objects
     * @author Jon Gales
     */
    public function query($query, $limit = 1000, $page = 0)
    {
        $params = array($this->_controller->api_key,
                        $this->_table,
                        $limit,
                        $page,
                        $query,
                        $this->_controller->fields[$this->_table]);
        
        $records = $this->_controller->send('DataService.query', $params);
        
        if (!$records)
        {
            return array();
        }
        
        $return_records = array();
        
        foreach ($records as $record)
        {
            $return_records[] = $this->_controller->Data($this->_table, $record);
        }
        
        return $return_records; 
    }
    
}