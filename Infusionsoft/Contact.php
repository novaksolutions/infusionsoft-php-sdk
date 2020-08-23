<?php

class Infusionsoft_Contact extends Infusionsoft_Generated_Contact{
    var $customFieldFormId = -1;
    public function __construct($id = null, $app = null){
    	parent::__construct($id, $app);    	    	
    }

    public function getInfusionsoftUrl($id = null, $app = null){
        if ($id == null){
            $id = $this->Id;
        }
        if ($app == null){
            $app = Infusionsoft_AppPool::getApp();
        }

        return 'https://' . $app->getHostname() . '/Contact/manageContact.jsp?view=edit&ID=' . $id;
    }
}

