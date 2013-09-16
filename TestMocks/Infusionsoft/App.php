<?php
class Infusionsoft_App{
    var $data;
    var $services = array();

	public function __construct($hostname, $apiKey, $port = 443){
        $this->data = new Infusionsoft_AppData();
        $this->services['DataService'] = new Infusionsoft_LowLevelDataService($this->data);
        $this->services['InvoiceService'] = new Infusionsoft_LowLevelInvoiceService($this->data);
        $this->services['APIAffiliateService'] = new Infusionsoft_LowLevelAPIAffiliateService($this->data);
        $this->services['FunnelService'] = new Infusionsoft_LowLevelFunnelService($this->data);
	}

    public function getService($name){
        if(isset($this->services[$name])){
            return $this->services[$name];
        } else {
            throw new Exception("Service $name not loaded in mock App.");
        }
    }

    public function enableDebug(){

    }

	public function getApiKey(){
        return "";
	}

	public function getHostname(){
		return "";
	}

	public function getPort(){
		return 0;
	}		

	public function getExceptions(){
		return array();
	}
	public function addException(Exception $e){

	}

	public function sendWithoutAddingKey($method, $args, $retry = false){
        $encoded_arguments = array();

        list($service, $method) = explode(".", $method);
        if(!isset($this->services[$service])){
            throw new Exception("No Low Level Service Provider for: " . $service);
        }

        if(!method_exists($this->services[$service], $method)){
            throw new Exception("Service provider doesn't provide method: $method");
        }

        $result = $this->services[$service]->$method($args);

        return $result;
	}

	public function send($method, $args, $retry = false){
		array_unshift($args, $this->getApiKey());
		return $this->sendWithoutAddingKey($method, $args, $retry);
	}

    public function getTotalHttpCalls(){
        return 0;
    }


    public function setTimeout($timeout) {

    }
}