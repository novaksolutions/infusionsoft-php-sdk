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

class Infusionsoft_Commission extends Infusionsoft_Generated_Base {

    protected static $tableFields = array(
        "Id", //This is non-numeric
        "AffiliateId",
        "ContactLastName",
        "SoldByLastName",
        "Description",
        "ContactFirstName",
        "AmtEarned",
        "InvoiceId",
        "ProductName",
        "ContactId",
        "SoldByFirstName",
        "DateEarned",
        "SaleAffId"
    );

    //Commissions don't actually have ids in Infusionsoft, so $idString is i of the form $affId/$date/$index
    public function __construct($idString = null, $app = null){
        $this->table = 'Commission';
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
        $commissions = Infusionsoft_APIAffiliateService::affCommissions($affiliateId, $dateString, $dateAndOneSecondString, $app);

        $commissionsInvoice = array(); //commissions with matching invoice Id
        foreach ($commissions as $commission) {
            if ($commission->InvoiceId == $invoiceId){
                $commissionsInvoice[] = $commission;
            }
        }

        if ($index >= 0 && $index < count($commissionsInvoice) )
            $this->data = $commissionsInvoice[$index]->toArray();
        else
            throw new Infusionsoft_Exception("Invalid commission Id");
    }

    /*public function loadFromArray($data){
        if (!array_key_exists('AffiliateId', $data) || !array_key_exists('InvoiceId', $data) || !array_key_exists('DateEarned', $data)){
            throw new Exception('Lacking necessary fields to create UniqueID for Commissions Object.');
        }
        $data['Id'] = 'AffId:' . $data['AffiliateId'] . 'InvoiceId:' . $data['InvoiceId'] . 'DateEarned:' . $data['DateEarned'];
        foreach ($this->getFields() as $field){
            $this->$field = NULL;
            if ($data && is_array($data) && isset($data[$field])){
                $this->$field = $data[$field];
            }
        }
    }*/
}