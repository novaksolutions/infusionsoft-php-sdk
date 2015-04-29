<?php
namespace NovakSolutions\Infusionsoft;

class SdkEvent {
    public $subject = null;
    public $params = array();

    public function __construct($subject, array $params = array()){
        $this->subject = $subject;
        $this->params = $params;
    }
}
