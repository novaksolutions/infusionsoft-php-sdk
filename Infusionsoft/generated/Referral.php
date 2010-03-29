<?php
class Infusionsoft_Generated_Referral extends Infusionsoft_Generated_Base{
    protected static $table_fields = array('Id', 'ContactId', 'AffiliateId', 'DateSet', 'DateExpires', 'IPAddress', 'Source', 'Info', 'Type');
    
    public function __construct(){
    	$this->table = 'Referral';
    }
}
