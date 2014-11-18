<?php
class Infusionsoft_Job extends Infusionsoft_Generated_Job{
    var $customFieldFormId = -9;
    
    public function __construct($id = null, $app = null){
    	parent::__construct($id, $app);    	    	
    }

    public function addCustomFields($fields){
        foreach($fields as $name){
            self::addCustomField($name);
        }
	}

    public function save($app = null){
        if($this->Id == ''){
            $invoiceId = Infusionsoft_InvoiceService::createBlankOrder($this->ContactId, $this->JobNotes, $this->DateCreated);
            $invoice = new Infusionsoft_Invoice($invoiceId);
            $this->Id = $invoice->JobId;
            $result = true;
        } else {
            $result = parent::save($app);
        }

        return $result;
    }
}

