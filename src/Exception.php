<?php
namespace NovakSolutions\Infusionsoft;

class Exception extends \Exception{
    public $message = '';
    public $method = '';
    public $args = '';

    public function __construct($message = null, $method = FALSE, $args = FALSE){
        $this->message = $message;
        $this->method = $method;
        $this->args = $args;
    }

    public function __toString(){
        return $this->message;
    }
}