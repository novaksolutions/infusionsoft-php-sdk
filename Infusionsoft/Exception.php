<?php

class Infusionsoft_Exception extends Exception
{
    public function __construct($message = null, $method = FALSE, $args = FALSE)
    {
        $this->message = $message;
        $this->method = $method;
        $this->args = $args;
    }

    public function __toString()
    {
        return $this->message;
    }
}