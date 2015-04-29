<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String CampaignId
 * @property String TemplateId
 * @property String StepStatus
 * @property String StepTitle
 */
class CampaignStep extends Base{
    protected static $tableFields = array('Id', 'CampaignId', 'TemplateId', 'StepStatus', 'StepTitle');

    public function __construct($id = null, $app = null){
        parent::__construct('CampaignStep', $id, $app);
    }
}

