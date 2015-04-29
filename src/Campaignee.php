<?php
namespace NovakSolutions\Infusionsoft;

/**
 * @property String Id
 * @property String Name
 * @property String Status
 */

class Campaignee extends Base{
    protected static $tableFields = array('CampaignId', 'Status', 'Campaign', 'ContactId');

    public function __construct($id = null, $app = null){
        parent::__construct('Campaignee', $id, $app);
    }
}

