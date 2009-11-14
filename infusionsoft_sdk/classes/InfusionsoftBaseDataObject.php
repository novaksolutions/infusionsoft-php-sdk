<?php
class InfusionsoftBaseDataObject {
    protected $_controller;
    protected $_table;

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
        if (!isset($this->_controller->fields[$this->_table]))
        {
            throw new Infusion_Exception(sprintf("Unknown table: %s", $this->_table));
        }
        
        foreach ($this->_controller->fields[$this->_table] as $field)
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
    
    /**
     * Returns an associative array of all the field data
     *
     * @return array
     * @author Jon Gales
     */
    public function fields()
    {
        $fields = array();
        
        foreach ($this->_controller->fields[$this->_table] as $field)
        {
            $fields[$field] = $this->$field;
        }
        
        return $fields;
    }
}
?>
