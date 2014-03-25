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
    protected $Logger;

	public function __construct($hostname, $apiKey, $port = 443){
		$this->hostname = $hostname;
		$this->apiKey = $apiKey;
		$this->port = $port;

		$this->client	= new xmlrpc_client('/api/xmlrpc', $this->getHostname(), $this->port);
		$this->client->setSSLVerifyPeer(true);
        $this->client->setCaCertificate(dirname(__FILE__) . '/infusionsoft.pem');
        $this->client->request_charset_encoding = "UTF-8";
	}

    public function logger(Infusionsoft_Logger $object){
        if (method_exists($object, 'log')){
            $this->Logger = $object;
        } else {
            throw new Exception('Required method "log" not found in object passed to App::statisticsLogger)');
        }
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
        $start = time();
        do{
            if ($attempts > 0){
                if (class_exists('CakeLog') && $attempts > 1){
                    $lastAttemptFaultCode = $req->faultCode();
                    $lastAttemptFaultString = $req->faultString();
                }
                sleep(5);
            }
            $attempts++;
            $req = $this->client->send($call, $this->timeout, 'https');
        } while($retry && ($req->faultCode() == $GLOBALS['xmlrpcerr']['invalid_return'] || $req->faultCode() == $GLOBALS['xmlrpcerr']['curl_fail'] || strpos($req->faultString(), 'com.infusionsoft.throttle.ThrottlingException: Maximum number of threads throttled') !== false) && $attempts < 3);

        $this->totalHttpCalls += $attempts;
        if (!$req->faultCode()){
            $result = php_xmlrpc_decode($req->value());
        } else {
            $result = array();
        }

        if (is_object($this->Logger)){
            $this->Logger->log(array(
                'time' => date('Y-m-d H:i:s'),
                'duration' => time() - $start,
                'method' => $method,
                'args' => $args,
                'attempts' => $attempts,
                'result' => $req->faultCode() ? 'Failed' : count($result) . ' Records Returned',
                'error_message' => $req->faultCode() ? $req->faultString() : null,
            ));
        }

		if ($req->faultCode()){
			$exception = new Infusionsoft_Exception($req->faultString() . "\nAttempted: $attempts time(s).", $method, $args);
			$this->addException($exception);			
			throw $exception; 
			return FALSE;
		}
        if ($attempts > 2){
            CakeLog::write('notice', "Infusionsoft call required $attempts calls to receive a successful response. Method: $method FaultCode: $lastAttemptFaultCode FaultString: $lastAttemptFaultString");
        }
		return $result;
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

    public static function formatDate($dateStr) {
        $dArray=date_parse($dateStr);
        if ($dArray['error_count']<1) {
            $tStamp =
                mktime($dArray['hour'],$dArray['minute'],$dArray['second'],$dArray['month'],
                    $dArray['day'],$dArray['year']);
            return date('Ymd\TH:i:s',$tStamp);
        } else {
            $message = '';
            foreach ($dArray['errors'] as $err) {
                $message .= "ERROR: " . $err . "\n";
            }
            throw new Infusionsoft_Exception($message);
        }
    }

}