<?php

class InfusionsoftCreditCard extends InfusionsoftBaseDataObject {
    
    /**
     * Infusion_Credit_Card objects are used by Infusion_Invoice objects to charge
     *
     * If you supply a numeric card number the card is verified to exist and if
     * so loaded as the object. Numbers can be supplied either as just the last
     * four or the entire CC number.
     *
     * Supplying an array as $card makes the class first attempt to verify the card
     * and if it does not exist add it and load it as the object.
     *
     *
     * @param object $controller 
     * @param object $contact 
     * @param mixed $card 
     * @author Jon Gales
     */
    public function __construct($infusionsoft_app, $contact, $card = FALSE)
    {
        $this->_infusionsoft_app = $infusionsoft_app;
        $this->_table = 'CreditCard';
        $this->_contact = $contact;

        $this->_reset_fields();
        
        if (is_numeric($card))
        {
            $this->locate_existing_card($card);
        }
        
        if (is_array($card))
        {
            if (isset($card['CardNumber']))
            {
                try
                {
                    $this->locate_existing_card($card['CardNumber']);
                }
                catch (InfusionException $e)
                {
                    $this->add($card);
                }
            }
            else
            {
                throw new InfusionException('You must supply a CreditCard value');
            }
        }
    }
    
    public function __tostring()
    {
        return 'Credit Card';
    }
    
    /**
     * Adds a credit card to a user
     *
     * @param array $card_data 
     * @return void
     * @author Jon Gales
     */
    public function add($card_data)
    {
        if (!$card_data['ContactId'])
        {
            if ($this->_contact->Id)
            {
                $card_data['ContactId'] = $this->_contact->Id;
            }
            else
            {
                throw new InfusionException("Card can't be added without a contact");
            }
        }
        
        if ($this->validate($card_data))
        {
            $params = array($this->_infusionsoft_app->api_key,
                            $this->_table,
                            $card_data);
                        
            $this->Id = $this->_infusionsoft_app->send('DataService.add', $params);
        }
        else
        {
            throw new InfusionException('Supplied card was invalid');
        }
        
    }
    
    /**
     * Verifies a card
     *
     * @param mixed $card_data 
     * @return bool
     * @author Jon Gales
     */
    public function validate($card = False)
    {
        if (!$card && !$this->Id)
        {
            throw new InfusionException('You must first supply or load a card before validating it');
        }
        
        $params = array($this->_infusionsoft_app->api_key,
                        $card);
                        
        $status = $this->_infusionsoft_app->send('InvoiceService.validateCreditCard', $params);
        
        if ($status['Valid'] != 'true')
        {
            throw new InfusionException(sprintf('Credit card invalid: %s', $status['Message']));
        }
        else{
            return TRUE;
        }

    }
    
    /**
     * Locates and loads a card if it exists. $card_number can be supplied as the whole
     * card number or just last four digits.
     *
     * @param int $card_number 
     * @return bool
     * @author Jon Gales
     */
    public function locate_existing_card($card_number)
    {
        if (!$this->_contact->Id)
        {
            throw new InfusionException('You must load a contact before checking a card');
        }
                
        if (strlen($card_number) > 4)
        {
            $last_4 = substr($card_number, -4);
        }
        else
        {
            $last_4 = $card_number;
        }
        
        $params = array($this->_infusionsoft_app->api_key,
                        $this->_contact->Id,
                        strval($last_4));
                        
        $card = $this->_infusionsoft_app->send('InvoiceService.locateExistingCard', $params);
        
        if ($card)
        {
            $this->Id = $card;
            return TRUE;
        }
        else
        {
            throw new InfusionException('No matching credit card found');
        }
        
        return FALSE;
    }
    
    

}