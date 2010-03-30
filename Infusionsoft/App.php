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

	public function getApiKey(){
		return $this->apiKey;
	}

	public function getHostname(){
		return $this->hostname;
	}		

	public function getExceptions(){
		return $this->exceptions;
	}
	public function addException(Exception $e){
		$this->exceptions[] = $e;
	}

	public function sendWithoutAddingKey($method, $args){
		$call = new xmlrpcmsg($method, array_map('php_xmlrpc_encode', $args));
		if($this->debug){echo 'Args:'; var_dump($args);}
		$req = $this->client->send($call, 0, 'https');
		if($this->debug) var_dump($req);		
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