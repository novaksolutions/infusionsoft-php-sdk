<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ContactId
 * @property String AffiliateId
 * @property String DateSet
 * @property String DateExpires
 * @property String IPAddress
 * @property String Source
 * @property String Info
 * @property String Type
 */
class Referral extends Generated_Referral{
    protected static $tableFields = array('Id', 'ContactId', 'AffiliateId', 'DateSet', 'DateExpires', 'IPAddress', 'Source', 'Info', 'Type');

    public function __construct($id = null, $app = null){
        parent::__construct('Referral', $id, $app);
    }
}

