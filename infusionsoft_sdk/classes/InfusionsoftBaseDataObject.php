<?php
class InfusionsoftBaseDataObject {
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
    
    
    /**
     * Resets all instance variables to make room for a new object
     * Optionally loads up another array or object of data
     * 
     * @param mixed data
     * @return void
     * @author Jon Gales
     */
    
    protected function _reset_fields($data = FALSE)
    {
        if (!isset($this->_infusionsoft_app->fields[$this->_table]))
        {
            throw new InfusionsoftException(sprintf("Unknown table: %s", $this->_table));
        }
        
        foreach ($this->_infusionsoft_app->fields[$this->_table] as $field)
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
    
    public function load($id)
    {
        if (!is_numeric($id))
        {
            throw InfusionsoftException('Id value must be numeric');
        }
        
        $params = array($this->_infusionsoft_app->api_key,
                        $this->_table,
                        intval($id),
                        $this->_infusionsoft_app->fields[$this->_table]);
                    
        $data = $this->_infusionsoft_app->send($this->_load_rpc_method, $params);
        
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
        foreach ($this->_infusionsoft_app->fields[$this->_table] as $field)
        {
            $fields[$field] = $this->$field;
        }        
        return $fields;
    }
}
?>
