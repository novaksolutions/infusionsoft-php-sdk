<?php
class Infusionsoft_App{
	protected $hostname = '';
	protected $apiKey = '';
	protected $port;
    protected $timeout = 0;
	protected $debug = false;

	protected $exceptions = array();
	protected $client;

    protected $totalHttpCalls = 0;

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

	public function sendWithoutAddingKey($method, $args, $retry = false){
        $encoded_arguments = array();
        foreach($args as $argument){
            $encoded_arguments[] = php_xmlrpc_encode($argument, array('auto_dates'));
        }

		$call = new xmlrpcmsg($method, $encoded_arguments);

        $attempts = 0;
        do{
            $attempts++;
            $req = $this->client->send($call, $this->timeout, 'https');
        } while($retry && ($req->faultCode() == $GLOBALS['xmlrpcerr']['invalid_return'] || $req->faultCode() == $GLOBALS['xmlrpcerr']['curl_fail']) && $attempts < 3);

        $this->totalHttpCalls += $attempts;

		if ($req->faultCode()){
			$exception = new Infusionsoft_Exception($req->faultString(), $method, $args); 
			$this->addException($exception);			
			throw $exception; 
			return FALSE;
		}
		return php_xmlrpc_decode($req->value());
	}
	public function send($method, $args, $retry = false){
		array_unshift($args, $this->getApiKey());
		return $this->sendWithoutAddingKey($method, $args, $retry);
	}

    public function getTotalHttpCalls(){
        return $this->totalHttpCalls;
    }


    public function setTimeout($timeout) {
        $this->timeout = $timeout;
    }
}