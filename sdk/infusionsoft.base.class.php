<?php

require_once('xmlrpc.inc');

function __autoload($class_name) {
    require 'classes/' . strtolower($class_name) . '.class.php';
}

/**
 * Custom Exception that tries to tell a little more about what 
 * went wrong with our XMLRPC calls.
 *
 * @author Jon Gales
 */
class InfusionException extends Exception { 
    public function __construct($message = null, $method = FALSE, $args = FALSE)
    {        
        $this->error = $message;
        $this->method = $method;
        $this->args = $args;
    }
    
    public function __toString()
    {
        return $this->error;
    }
}

/**
 * Child methods extend this class to provide custom functionality,
 * these are a few common methods to them all
 *
 * @author Jon Gales
 */
class InfusionBaseChild {
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

/**
 * PHP interface to the InfusionSoft API
 *
 * @package default
 */
 
class Infusionsoft {
	
	public $app_name;
	public $api_key;
	public $fields;
	
	public function __construct($app_name, $api_key, $merchant_acct = False)
	{
		$this->app_name = $app_name;
		$this->api_key 	= $api_key;
		$this->url 		= sprintf('%s.infusionsoft.com', $this->app_name);
		$this->client	= new xmlrpc_client('/api/xmlrpc', $this->url, 443);
		$this->merchant_acct = $merchant_acct;
		
		$this->client->setSSLVerifyPeer(0);
		
		$this->_parse_fields();
	}
	
	/**
	 * Parses the field XML file to get the most up to date field names available
	 *
	 * @return void
	 * @author Jon Gales
	 */
	private function _parse_fields()
	{
        if (!($dom = new DomDocument()))
        { 
			throw new InfusionException('Cannot create new DomDocument()');
			return FALSE;
        }
        
        $dom->load('infusionsoft/API_Field_Access.xml');
        
        foreach($dom->getElementsByTagName('table') as $table)
        {
            $this->fields[$table->getAttribute('name')] = array();
            foreach($table->getElementsByTagName('field') as $field)
            {
                $this->fields[$table->getAttribute('name')][] = $field->getAttribute('name');
            }
        }
        
	}
	
	/**
	 * Wrapper around the XML-RPC Client send() method to automatically make
	 * the request use SSL.
	 *
	 * We automatically convert all args to XMLRPC types with php_xmlrpc_encode()
	 *
	 * @param object $call 
	 * @return mixed bool false or object
	 * @author Jon Gales
	 */
	public function send($method, $args)
	{
		
		$call = new xmlrpcmsg($method, array_map('php_xmlrpc_encode', $args));
		
		$req = $this->client->send($call, 0, 'https');

		if ($req->faultCode())
		{
			throw new InfusionException($req->faultString(), $method, $args);
			return FALSE;
		}
        
		return php_xmlrpc_decode($req->value());
	}
	
	/**
	 * Return current time in InfusionSoft's required format
	 *
	 * @return string
	 * @author Jon Gales
	 */
	public function date($bump_days=FALSE)
	{
	    if ($bump_days)
	    {
	        return date('Ymd\TH:i:s', mktime(0, 0, 0, date("m")  , date("d")+$bump_days, date("Y")));
	    }
	    
		return date('Ymd\TH:i:s');
	}
	
	/**
	 * Helper method to check if the given fields associative array has
	 * all blank values. Used for when data methods want to prevent saving
	 * empty records.
	 *
	 * @param array $fields 
	 * @return bool
	 * @author Jon Gales
	 */
	public function fields_are_blank($fields)
	{
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
	
	/**
	 * Bool test for Infusion Soft's API
	 *
	 * @return bool
	 * @author Jon Gales
	 */
	public function ping_test()
	{
		
		if ($this->send('DataService.echo', array('Hello World', 2)))
		{
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function Contact($contact = FALSE)
	{
        return new Infusion_Contact($this, $contact);
	}

	public function Product($product = FALSE)
	{
	    return new Infusion_Product($this, $product);
	}

	public function Data($table, $initial_data = FALSE)
	{
	    return new Infusion_Data($this, $table, $initial_data);
	}

}


