<?php
class Infusionsoft {
	
	public $app_name;
	public $api_key;
	public $fields;
	
	public function __construct($host = '', $api_key = '', $merchant_acct = False){		
		if($host == '') $host = $GLOBALS['infusionsoft_host'];
		if($api_key == '') $api_key = $GLOBALS['infusionsoft_api_key'];
						
		$this->api_key 	= $api_key;
		$this->url 		= $host;
		$this->client	= new xmlrpc_client('/api/xmlrpc', $this->url, 443);
		$this->merchant_acct = $merchant_acct;
		
		$this->client->setSSLVerifyPeer(0);
		
		$this->_parse_api_field_access();
	}
		
	private function _parse_api_field_access()
	{
        if (!($dom = new DomDocument()))
        { 
			throw new InfusionsoftException('Cannot create new DomDocument()');
			return FALSE;
        }
        
        $dom->load(dirname(dirname(__FILE__)) . '/misc/API_Field_Access.xml');
        
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
		if($GLOBALS['infusionsoft_debug']){echo 'Args:'; var_dump($args);}
		$req = $this->client->send($call, 0, 'https');
		if($GLOBALS['infusionsoft_debug']) var_dump($req);				
		if ($req->faultCode())
		{
			throw new InfusionsoftException($req->faultString(), $method, $args);
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
	public function ping()
	{
		$out = false;
		try{
			$result = $this->send('DataService.echo', array('Hello World'));
			if($result) $out = true;			
		}		
		catch(Exception $e){
			$GLOBALS['infusionsoft_last_exception'] = $e;
			$out = FALSE;
		}
		
		return $out;
	}
	
	public function Contact($contact = FALSE)
	{
        return new InfusionsoftContact($this, $contact);
	}

	public function Product($product = FALSE)
	{
	    return new InfusionsoftProduct($this, $product);
	}

	public function Data($table, $initial_data = FALSE)
	{
	    return new InfusionsoftData($this, $table, $initial_data);
	}

}


