<?php

class InfusionsoftContact extends InfusionsoftData {
    
	public function __construct($initial_data = false){		
		parent::__construct("Contact", $initial_data);		
	}
	
	
    /*
     public function __construct($_infusionsoft_app, $contact = FALSE){
    	$this->_factoryMethodNameInApp = 'Contact';
    	$this->_load_rpc_method = 'ContactService.load';
        $this->__infusionsoft_app = $_infusionsoft_app;
        $this->_table = 'Contact';
        $this->_reset_fields();                       
        
        if ($contact){
            if (is_numeric($contact)){
                $this->load($contact);
            }
            
            if (is_array($contact)){
                $this->loadFromArray($contact);
            }
        }
        
    }
    */
    
    public function __toString() {
        
        if ($this->FirstName && $this->LastName)
        {
            $return = sprintf("%s %s", $this->FirstName, $this->LastName);
        }
        elseif ($this->Email)
        {
            $return = $this->Email;
        } 
        else
        {
            $return = 'Infusionsoft User';
        }
        
        if ($this->Id)
        {
            $return = sprintf("%s (#%d)", $return, $this->Id); 
        }
        else
        {
            $return = sprintf('%s (Unsaved)', $return);
        }
        
        return $return;
    }
    
    /**
     * Clears existing values and loads a contact from a contact data array
     *
     * @param array $contact_data 
     * @return void
     * @author Jon Gales
     */
    private function loadFromArray($contact_data)
    {
        if (!isset($contact_data['Id']))
        {
            throw new InfusionException('An Id must be provided to load a contact');
        }
        
        $this->_reset_fields();
        
        foreach ($contact_data as $col => $val)
        {
            $this->$col = $val;
        }
    }   
    
    /**
     * Adds a contact to the database
     *
     * @param array $data 
     * @return object
     * @author Jon Gales
     */
    public function add($data)
    {
        $params = array($data);
                
        $contact_id = $this->_infusionsoft_app->send('ContactService.add', $params);
        
        return $this->_infusionsoft_app->Contact($contact_id);
    }
    
    /**
     * Adds multiple field values at once using a supplied array
     *
     * @param array $values 
     * @return bool
     * @author Jon Gales
     */
    public function add_values($values)
    {
        if (!is_array($values))
        {
            return FALSE;
        }
        
        foreach ($values as $field=>$val)
        {
            $this->$field = $val;
        }
        
        return TRUE;
    }
    
    /**
     * Returns all matching contacts for a given email address
     * The return is an array of Contact objects
     *
     * @param string $email 
     * @param bool $return_as_objects 
     * @return bool FALSE or array
     * @author Jon Gales
     */
    public function find_by_email($email, $return_as_objects = TRUE)
    {        
        $params = array($email,
                        $this->_infusionsoft_app->fields[$this->_table]);
                    
        $contacts = $this->_infusionsoft_app->send('ContactService.findByEmail', $params);
        
        if (!$contacts)
        {
            return FALSE;
        }
        
        if ($return_as_objects)
        {
            $return_contacts = array();
        
            foreach ($contacts as $contact)
            {
                $return_contacts[] = $this->_infusionsoft_app->Contact($contact);
            }
        
            return $return_contacts;
        }
        
        return $contacts;
    }
    
    /**
     * Wrapper around find_by_email to limit results to a single contact
     * If a single contact is found that contact's Infusion_Contact object
     * is loaded. If no contacts are found boolean FALSE is returned. If
     * multiple contacts are found an exception is thrown.
     *
     * @param string $email 
     * @return bool
     * @author Jon Gales
     */
    public function find_one_by_email($email)
    {
        
        $contacts = $this->find_by_email($email, FALSE);
        
        if (!$contacts)
        {
            return FALSE;
        }
        elseif (count($contacts) == 1)
        {
            $this->_load_array_as_contact($contacts[0]);
            return TRUE;
        }
        else
        {
            throw new InfusionException('More than one contact was found with ' . $email);
        }
    }
    
    /**
     * Adds a contact to a group (AKA tag)
     *
     * @param int $group_id 
     * @return bool
     * @author Jon Gales
     */
    public function add_to_group($group_id)
    {
        if (!$this->Id)
        {
            throw new InfusionException('You must load a contact before adding to a group');
        }
        
        $params = array($this->Id,
                        $group_id);
                        
        $this->_infusionsoft_app->send('ContactService.addToGroup', $params);
    }

    /**
     * Removes a contact from a group (AKA tag)
     *
     * @param int $group_id 
     * @return bool
     * @author Jon Gales
     */
    public function remove_from_group($group_id)
    {
        if (!$this->Id)
        {
            throw new InfusionException('You must load a contact before removing it from a group');
        }
        
        $params = array($this->Id,
                        $group_id);
                        
        $this->_infusionsoft_app->send('ContactService.removeFromGroup', $params);
    }
        
    /**
     * Saves the current contact by either updating it to Infusionsoft or creating it
     *
     * @return int
     * @author Jon Gales
     */
    public function save()
    {
        if ($this->Id)
        {
            $params = array($this->Id,
                            $this->fields());
            return $this->_infusionsoft_app->send('ContactService.update', $params);
        }
        
        if ($this->_infusionsoft_app->fields_are_blank($this->fields()))
        {
            throw new InfusionException('Cannot save blank contacts');
        }
        
        $params = array($this->_infusionsoft_app->api_key,
                        $this->fields());
            
        $this->Id = $this->_infusionsoft_app->send('ContactService.add', $params);
        
        return $this->Id;
    }
    
    public function Credit_Card($last_4 = FALSE)
    {
        return new InfusionCreditCard($this->_infusionsoft_app, $this, $last_4);
    }
    
    public function Invoice($invoice = FALSE)
	{
	    return new InfusionInvoice($this->_infusionsoft_app, $this, $invoice);
	}
}