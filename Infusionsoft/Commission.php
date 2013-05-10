<?php
/**
 * Created by JetBrains PhpStorm.
 * User: prescott
 * Date: 5/3/13
 * Time: 12:42 PM
 * To change this template use File | Settings | File Templates.
 */

class Infusionsoft_Commission extends Infusionsoft_Generated_Base {

    protected static $tableFields = array(
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

    public function __construct($id = null, $app = null){
        parent::__construct('Affiliate', $id, $app);
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

}