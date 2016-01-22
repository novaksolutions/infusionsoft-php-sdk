<?php
class Infusionsoft_Payment extends Infusionsoft_Generated_Payment{	
    public function __construct($id = null, $app = null){
    	parent::__construct($id, $app);    	    	
    }


    public function __set($name, $value){
        if($name == 'OrderId'){
            $invoices = Infusionsoft_DataService::query(new Infusionsoft_Invoice(), array('JobId' => $value));
            $invoice = array_shift($invoices);
            $this->InvoiceId = $invoice->Id;
        } else {
            parent::__set($name, $value);
        }
    }

    public function save($app = null){
        if($this->Id == ''){
            $success = Infusionsoft_InvoiceService::addManualPayment($this->InvoiceId, $this->PayAmt, $this->PayDate, $this->PayType, $this->PayNote, false, $app);
            if(!$success){
                throw new Infusionsoft_Exception("Failed while saving payment: " . json_encode($this->toArray()));
            }
            $this->Id = 'Created, But, Cannot Get Id';
        }

        return true;
    }
}

