<?php

class Infusion_Contact extends InfusionBaseChild {
    
    public function __construct($controller, $contact = FALSE)
    {
        $this->_controller = $controller;
        $this->_table = 'Contact';
        $this->_reset_fields();                       
        
        if ($contact)
        {
            if (is_numeric($contact))
            {
                $this->load($contact);
            }
            
            if (is_array($contact))
            {
                $this->_load_array_as_contact($contact);
            }
        }
        
    }
    
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
    private function _load_array_as_contact($contact_data)
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
     * Loads a contact from Infusionsoft
     *
     * @param int $contact_id 
     * @return void
     * @author Jon Gales
     */
    public function load($contact_id)
    {
        $this->_reset_fields();
        
        $params = array($this->_controller->api_key, 
                        $contact_id, 
                        $this->_controller->fields[$this->_table]);
        
        $contact = $this->_controller->send('ContactService.load', $params);
        
        $this->_load_array_as_contact($contact);
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
        $params = array($this->_controller->api_key, 
                        $data);
                
        $contact_id = $this->_controller->send('ContactService.add', $params);
        
        return $this->_controller->Contact($contact_id);
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
        $params = array($this->_controller->api_key,
                        $email,
                        $this->_controller->fields[$this->_table]);
                    
        $contacts = $this->_controller->send('ContactService.findByEmail', $params);
        
        if (!$contacts)
        {
            return FALSE;
        }
        
        if ($return_as_objects)
        {
            $return_contacts = array();
        
            foreach ($contacts as $contact)
            {
                $return_contacts[] = $this->_controller->Contact($contact);
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
        
        $params = array($this->_controller->api_key,
                        $this->Id,
                        $group_id);
                        
        $this->_controller->send('ContactService.addToGroup', $params);
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
        
        $params = array($this->_controller->api_key,
                        $this->Id,
                        $group_id);
                        
        $this->_controller->send('ContactService.removeFromGroup', $params);
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
            $params = array($this->_controller->api_key,
                            $this->Id,
                            $this->fields());
            return $this->_controller->send('ContactService.update', $params);
        }
        
        if ($this->_controller->fields_are_blank($this->fields()))
        {
            throw new InfusionException('Cannot save blank contacts');
        }
        
        $params = array($this->_controller->api_key,
                        $this->fields());
            
        $this->Id = $this->_controller->send('ContactService.add', $params);
        
        return $this->Id;
    }
    
    public function Credit_Card($last_4 = FALSE)
    {
        return new Infusion_Credit_Card($this->_controller, $this, $last_4);
    }
    
    public function Invoice($invoice = FALSE)
	{
	    return new Infusion_Invoice($this->_controller, $this, $invoice);
	}
}