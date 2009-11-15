<?php

class InfusionsoftData extends InfusionsoftBaseDataObject {    
    public function __construct($infusionsoft_app, $table, $initial_data)
    {
        $this->_load_rpc_method = 'DataService.load';        
        $this->_infusionsoft_app = $infusionsoft_app;
        $this->_table = $table;        
        if (!$this->_infusionsoft_app->table_exists($table)){
            throw new InfusionsoftException('Unknown table');
        }
                        
        if ($initial_data){
            $this->_reset_fields($initial_data);
        }
    }
             
    public function save()
    {
        if ($this->Id)
        {
            $params = array($this->_infusionsoft_app->api_key,
                            $this->_table,
                            $this->Id,
                            $this->fields());
            return $this->_infusionsoft_app->send('DataService.update', $params);
        }
        
        if ($this->_infusionsoft_app->fields_are_blank($this->fields()))
        {
            throw new InfusionException(sprintf('Cannot save a blank %s record', $this->_table));
        }
        
        $params = array($this->_infusionsoft_app->api_key,
                        $this->_table,
                        $this->fields());
            
        $this->Id = $this->_infusionsoft_app->send('DataService.add', $params);
        
        return $this->Id;

    }
    
    public function find_by_field($field, $value, $limit = 1000, $page = 0)
    {
        $params = array($this->_infusionsoft_app->api_key,
                        $this->_table,
                        $limit,
                        $page,
                        $field,
                        $value,
                        $this->_infusionsoft_app->fields[$this->_table]);
                        
        $records = $this->_infusionsoft_app->send('DataService.findByField', $params);
        
        if (!$records){
            return array();
        }
        
        $return_records = array();
        
        foreach ($records as $record){
            $return_records[] = $this->_infusionsoft_app->Data($this->_table, $record);
        }
        
        return $return_records;        
    }
     
    public function query($query, $limit = 1000, $page = 0)
    {
        $params = array($this->_infusionsoft_app->api_key,
                        $this->_table,
                        $limit,
                        $page,
                        $query,
                        $this->_infusionsoft_app->fields[$this->_table]);
        
        $records = $this->_infusionsoft_app->send('DataService.query', $params);
        
        if (!$records)
        {
            return array();
        }
        
        $return_records = array();
        
        foreach ($records as $record)
        {
            $return_records[] = $this->_infusionsoft_app->Data($this->_table, $record);
        }
        
        return $return_records; 
    }
    
}