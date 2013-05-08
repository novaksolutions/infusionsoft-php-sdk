<?php
class Infusionsoft_Affiliate extends Infusionsoft_Generated_Affiliate{
    var $customFieldFormId = -3;
    public function __construct($id = null, $app = null){
    	parent::__construct($id, $app);    	    	
    }

    /*
    public function getCommissions($startDate, $endDate) {
        $commissionData = Infusionsoft_APIAffiliateService::affCommissions($this->Id, $startDate, $endDate);

        foreach ($commissionData)
    }
    */
}

