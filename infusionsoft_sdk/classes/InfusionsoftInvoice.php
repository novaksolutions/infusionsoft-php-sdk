<?php

class InfusionsoftInvoice extends InfusionsoftBaseDataObject {
    
    public function __construct($infusionsoft_app, $contact, $invoice = FALSE)
    {
        if (!$contact->Id)
        {
            throw new InfusionException('A contact must be loaded before an invoice can be initialized');
        }
        
        $this->_infusionsoft_app  = $infusionsoft_app;
        $this->_table       = 'Invoice';
        $this->_contact     = $contact;

        if (!$invoice)
        {
            $this->create();
        }
        
        if (is_numeric($invoice))
        {
            $this->Id = $invoice;
        }
            
    }
    
    /**
     * Creates a new blank invoice and loads it as the current Infusion_Invoice object
     *
     * @return int
     * @author Jon Gales
     */
    public function create($desc = 'API Order')
    {
        $this->_reset_fields();
        
        $params = array($this->_infusionsoft_app->api_key,
                        $this->_contact->Id,
                        $desc,
                        php_xmlrpc_encode($this->_infusionsoft_app->date(),array('auto_dates')),
                        0,
                        0);

        $invoice = $this->_infusionsoft_app->send('InvoiceService.createBlankOrder', $params);
        
        $this->Id = $invoice;

        return $invoice;
    }
    
    /**
     * Returns all the payments for the current invoice
     *
     * @return array
     * @author Jon Gales
     */
    public function get_payments()
    {
        $params = array($this->_infusionsoft_app->api_key,
                        $this->Id);
                        
        return $this->_infusionsoft_app->send('InvoiceService.getPayments', $params);
    }
    
    /**
     * Adds an Infusion_Product to the existing invoice
     *
     * @param object $product 
     * @param int $quantity 
     * @param int $type 
     * @return bool
     * @author Jon Gales
     */
    public function add($product, $quantity = 1, $type = 0)
    {
        $params = array($this->_infusionsoft_app->api_key,
                        $this->Id,
                        $product->Id,
                        $type,
                        $product->ProductPrice,
                        $quantity,
                        $product->ShortDescription,
                        $product->Description);
                        
        return $this->_infusionsoft_app->send('InvoiceService.addOrderItem', $params);

    }
    
    #TODO
    public function add_payment_plan($auto_charge = TRUE, $days_between_retry = 2, $max_retry = 3)
    {
        if (!$this->_infusionsoft_app->merchant_acct)
        {
            throw new InfusionException('You must set a merchant account before charging an invoice');
        }

        $params = array($this->_infusionsoft_app->api_key,
                        $this->Id,
                        $auto_charge,
                        $card,
                        $this->_infusionsoft_app->merchant_acct,
                        $days_between_retry,
                        $max_retry,
                        $product->Description);
                        
        return $this->_infusionsoft_app->send('InvoiceService.addOrderItem', $params);
    }
    
    
    /**
     * Applies taxes to the current invoice. We automatically run this in the 
     * charge() method.
     *
     * @return void
     * @author Jon Gales
     */
    private function recalculate_tax()
    {
        $params = array($this->_infusionsoft_app->api_key,
                        $this->Id);
                        
        return $this->_infusionsoft_app->send('InvoiceService.recalculateTax', $params);
    }

    /**
     * Returns any remaining total on the curent invoice
     *
     * @return float
     * @author Jon Gales
     */
    public function calculate_amount_owed()
    {
        $params = array($this->_infusionsoft_app->api_key,
                        $this->Id);
                        
        return $this->_infusionsoft_app->send('InvoiceService.calculateAmountOwed', $params);
    }
    
    /**
     * Charges the invoice with the given Infusion_Credit_Card object
     *
     * @param object $card 
     * @return bool
     * @author Jon Gales
     */
    public function charge($card, $notes = "", $bypass_commissions = FALSE)
    {
        if (!$this->_infusionsoft_app->merchant_acct)
        {
            throw new InfusionException('You must set a merchant account before charging an invoice');
        }
        
        $this->recalculate_tax();
        
        $params = array($this->_infusionsoft_app->api_key,
                        $this->Id,
                        $notes,
                        $card->Id,
                        $this->_infusionsoft_app->merchant_acct,
                        $bypass_commissions);
                        
        return $this->_infusionsoft_app->send('InvoiceService.chargeInvoice', $params);

    }
        
        

    

        
}