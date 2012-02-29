<?php
class Infusionsoft_App{
	protected $hostname = '';
	protected $apiKey = '';
	protected $port;
	protected $debug = false;

	protected $exceptions = array();
	protected $client;

	public function __construct($hostname, $apiKey, $port = 443){
		$this->hostname = $hostname;
		$this->apiKey = $apiKey;
		$this->port = $port;

		$this->client	= new xmlrpc_client('/api/xmlrpc', $this->getHostname(), $this->port);
		$this->client->setSSLVerifyPeer(0);
	}

    public function enableDebug(){
        $this->debug = true;
        $this->client->dump_payloads = true;
    }

	public function getApiKey(){
		return $this->apiKey;
	}

	public function getHostname(){
		return $this->hostname;
	}

	public function getPort(){
		return $this->port;
	}		

	public function getExceptions(){
		return $this->exceptions;
	}
	public function addException(Exception $e){
		$this->exceptions[] = $e;
	}

	public function sendWithoutAddingKey($method, $args){
        $encoded_arguments = array();
        foreach($args as $argument){
            $encoded_arguments[] = php_xmlrpc_encode($argument, array('auto_dates'));
        }

		$call = new xmlrpcmsg($method, $encoded_arguments);
		$req = $this->client->send($call, 0, 'https');
		if ($req->faultCode()){
			$exception = new Infusionsoft_Exception($req->faultString(), $method, $args); 
			$this->addException($exception);			
			throw $exception; 
			return FALSE;
		}
		return php_xmlrpc_decode($req->value());
	}
	public function send($method, $args){
		array_unshift($args, $this->getApiKey());
		return $this->sendWithoutAddingKey($method, $args);	
	}
}