<?php
/**
 * Created by JetBrains PhpStorm.
 * User: prescott
 * Date: 5/3/13
 * Time: 12:42 PM
 * To change this template use File | Settings | File Templates.
 * @property String $Id
 * @property String $AffiliateId
 * @property String $ContactLastName
 * @property String $SoldByLastName
 * @property String $Description
 * @property String $ContactFirstName
 * @property String $AmtEarned
 * @property String $InvoiceId
 * @property String $ProductName
 * @property String $ContactId
 * @property String $SoldByFirstName
 * @property String $DateEarned
 * @property String $SaleAffId
 */

class Infusionsoft_Clawback extends Infusionsoft_Generated_Base {

    protected static $tableFields = array(
        "Id", //This is non-numeric
        "Description",
        "Amount",
        "InvoiceId",
        "FirstName",
        "ProductName",
        "ContactId",
        "SoldByFirstName",
        "DateEarned",
        "SaleAffId",
    );

    //Clawbacks don't actually have ids in Infusionsoft, so $idString is i of the form $affId/$date/$index
    public function __construct($idString = null, $app = null){
        $this->table = 'Clawback';
        if (is_array($idString)){
            $this->loadFromArray($idString);
        }
        if ($idString != null) {
            $this->load($idString, $app);
        }
    }

    public function getFields(){
        return self::$tableFields;
    }

    public function addCustomField($name){
        self::$tableFields[] = $name;
    }

    public function addCustomFields($fields){
        foreach($fields as $name){
            self::addCustomField($name);
        }
    }

    public function removeField($fieldName){
        $fieldIndex = array_search($fieldName, self::$tableFields);
        if($fieldIndex !== false){
            unset(self::$tableFields[$fieldIndex]);
            self::$tableFields = array_values(self::$tableFields);
        }
    }

    public function save() {
        throw new Infusionsoft_Exception("Commissions cannot be saved");
    }

    public function load($idString, $app = null) {
        //parse $idString
        $this->Id = $idString;
        $idArray = explode('/', $idString);
        $affiliateId = $idArray[0];
        $invoiceId = $idArray[1];
        $dateString = $idArray[2];
        $index = $idArray[3];

        $date = DateTime::createFromFormat(Infusionsoft_Service::apiDateFormat, $dateString);
        $dateString = $date->format(Infusionsoft_Service::apiDateFormat);
        $date->modify('+1 second');
        $dateAndOneSecondString = $date->format('Ymd\TH:i:s');

        //This is the base method that returns a data array
        $clawbacks = Infusionsoft_APIAffiliateService::affClawbacks($affiliateId, $dateString, $dateAndOneSecondString, $app);

        $clawbacksInvoice = array(); //commissions with matching invoice Id
        foreach ($clawbacks as $clawback) {
            if ($clawback->InvoiceId == $invoiceId){
                $clawbacksInvoice[] = $clawback;
            }
        }

        if ($index >= 0 && $index < count($clawbacksInvoice) )
            $this->data = $clawbacksInvoice[$index]->toArray();
        else
            throw new Infusionsoft_Exception("Invalid commission Id");
    }
}