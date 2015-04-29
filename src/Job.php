<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String JobTitle
 * @property String ContactId
 * @property String StartDate
 * @property String DueDate
 * @property String JobNotes
 * @property String ProductId
 * @property String JobRecurringId
 * @property String JobStatus
 * @property String DateCreated
 * @property String OrderType
 * @property String OrderStatus
 * @property String ShipFirstName
 * @property String ShipMiddleName
 * @property String ShipLastName
 * @property String ShipCompany
 * @property String ShipPhone
 * @property String ShipStreet1
 * @property String ShipStreet2
 * @property String ShipCity
 * @property String ShipState
 * @property String ShipZip
 * @property String ShipCountry
 */
class Job extends BaseWithCustomFields{
    protected static $tableFields = array('Id', 'JobTitle', 'ContactId', 'StartDate', 'DueDate', 'JobNotes', 'ProductId', 'JobRecurringId', 'JobStatus', 'DateCreated', 'OrderType', 'OrderStatus', 'ShipFirstName', 'ShipMiddleName', 'ShipLastName', 'ShipCompany', 'ShipPhone', 'ShipStreet1', 'ShipStreet2', 'ShipCity', 'ShipState', 'ShipZip', 'ShipCountry');
    public static $customFieldFormId = -9;

    public function __construct($id = null, $app = null){
        parent::__construct('Job', $id, $app);
    }

    public function save($app = null){
        if($this->Id == ''){
            $invoiceId = InvoiceService::createBlankOrder($this->ContactId, $this->JobNotes, $this->DateCreated);
            $invoice = new Invoice($invoiceId);
            $this->Id = $invoice->JobId;
        }

        $result = parent::save($app);

        return $result;
    }
}

