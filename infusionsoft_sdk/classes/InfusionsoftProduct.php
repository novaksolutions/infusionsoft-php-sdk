<?php

class InfusionsoftProduct extends InfusionsoftBaseDataObject {
    
    public function __construct($controller, $product)
    {
        $this->_controller = $controller;
        $this->_table = 'Product';
        
        $this->_reset_fields();
        
        if (is_numeric($product))
        {
            $this->load($product);
        }
        
        if (is_array($product))
        {
            foreach ($product as $col => $val)
            {
                $this->$col = $val;
            }
        }
    }
    
    /**
     * Loads a product object
     *
     * @param int $product_id 
     * @return void
     * @author Jon Gales
     */
    public function load($product_id)
    {
        $params = array($this->_controller->api_key,
                        $this->_table,
                        $product_id,
                        $this->_controller->fields[$this->_table]);
                        
        foreach ($this->_controller->send('DataService.load', $params) as $col => $val)
        {
            $this->$col = $val;
        }
        
    }
    
    /**
     * Either updates or adds a product depending on if it already exists or not
     *
     * @return void
     * @author Jon Gales
     */
    public function save()
    {
    
        if ($this->Id)
        {
            
            $params = array($this->_controller->api_key,
                            $this->_table,
                            $product_id,
                            $this->fields());
                        
            return $this->_controller->send('DataService.update', $params);
        }
        
        $params = array($this->_controller->api_key,
                        $this->_table,
                        $this->fields());
            
        $this->Id = $this->_controller->send('DataService.add', $params);
        
    }
    
    /**
     * Returns array of all product objects
     *
     * @return array
     * @author Jon Gales
     */
    public function list_all()
    {
        $params = array($this->_controller->api_key,
                        $this->_table,
                        1000,
                        0,
                        array('Id'=>'%'),
                        $this->_controller->fields[$this->_table]);
            
        $products = $this->_controller->send('DataService.query', $params);
        
        $return_products = array();
        
        foreach ($products as $product)
        {
            $return_products[] = $this->_controller->Product($product);
        }
        
        return $return_products;
    }
    
}