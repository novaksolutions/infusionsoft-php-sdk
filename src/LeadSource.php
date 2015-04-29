<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String Name
 * @property String Description
 * @property String StartDate
 * @property String EndDate
 * @property String CostPerLead
 * @property String Vendor
 * @property String Medium
 * @property String Message
 * @property String LeadSourceCategoryId
 * @property String Status
 */
class LeadSource extends Base{
    protected static $tableFields = array('Id', 'Name', 'Description', 'StartDate', 'EndDate', 'CostPerLead', 'Vendor', 'Medium', 'Message', 'LeadSourceCategoryId', 'Status');

    public function __construct($id = null, $app = null){
        parent::__construct('LeadSource', $id, $app);
    }
}

