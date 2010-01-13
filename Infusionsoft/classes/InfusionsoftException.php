<?php
class InfusionsoftException extends Exception { 
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
?>
