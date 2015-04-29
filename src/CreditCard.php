<?php
namespace NovakSolutions\Infusionsoft;
/**
 * @property String Id
 * @property String ContactId
 * @property String BillName
 * @property String FirstName
 * @property String LastName
 * @property String PhoneNumber
 * @property String Email
 * @property String BillAddress1
 * @property String BillAddress2
 * @property String BillCity
 * @property String BillState
 * @property String BillZip
 * @property String BillCountry
 * @property String ShipFirstName
 * @property String ShipMiddleName
 * @property String ShipLastName
 * @property String ShipCompanyName
 * @property String ShipPhoneNumber
 * @property String ShipAddress1
 * @property String ShipAddress2
 * @property String ShipCity
 * @property String ShipState
 * @property String ShipZip
 * @property String ShipCountry
 * @property String ShipName
 * @property String NameOnCard
 * @property String CardNumber
 * @property String Last4
 * @property String ExpirationMonth
 * @property String ExpirationYear
 * @property String CVV2
 * @property String Status
 * @property String CardType
 * @property String StartDateMonth
 * @property String StartDateYear
 * @property String MaestroIssueNumber
 */
class CreditCard extends Base{
    protected static $tableFields = array('Id', 'ContactId', 'BillName', 'FirstName', 'LastName', 'PhoneNumber', 'Email', 'BillAddress1', 'BillAddress2', 'BillCity', 'BillState', 'BillZip', 'BillCountry', 'ShipFirstName', 'ShipMiddleName', 'ShipLastName', 'ShipCompanyName', 'ShipPhoneNumber', 'ShipAddress1', 'ShipAddress2', 'ShipCity', 'ShipState', 'ShipZip', 'ShipCountry', 'ShipName', 'NameOnCard', 'CardNumber', 'Last4', 'ExpirationMonth', 'ExpirationYear', 'CVV2', 'Status', 'CardType', 'StartDateMonth', 'StartDateYear', 'MaestroIssueNumber');

    public function __construct($id = null, $app = null){
        parent::__construct('CreditCard', $id, $app);
    }

    public function removeRestrictedFields(){
        $restrictedFields = array(
            'CardNumber',
            'CVV2'
        );
        foreach ($restrictedFields as $restrictedField){
            self::removeField($restrictedField);
        }
    }

    public function addRestrictedFields(){
        $restrictedFields = array(
            'CardNumber',
            'CVV2'
        );
        foreach ($restrictedFields as $restrictedField){
            self::addCustomField($restrictedField);
        }
    }
}

