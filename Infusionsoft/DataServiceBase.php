<?php
class Infusionsoft_DataServiceBase extends Infusionsoft_Service{

    public static function add($table, $values, Infusionsoft_App $app = null){
        $params = array(
            $table, 
            $values
        );

        return parent::send($app, "DataService.add", $params);
    }
    
    public static function checkPermission($userId, $module, $setting, Infusionsoft_App $app = null){
        $params = array(
            (int) $userId, 
            $module, 
            $setting
        );

        return parent::send($app, "DataService.checkPermission", $params);
    }
    
    public static function load($table, $id, $selectedFields, Infusionsoft_App $app = null){
        $params = array(
            $table, 
            $id, 
            $selectedFields
        );

        return parent::send($app, "DataService.load", $params);
    }
    
    public static function delete($table, $id, Infusionsoft_App $app = null){
        $params = array(
            $table, 
            (int) $id
        );

        return parent::send($app, "DataService.delete", $params);
    }
    
    public static function query($table, $limit, $page, $queryData, $selectedFields, $orderBy, $ascending, Infusionsoft_App $app = null){
        $params = array(
            $table, 
            (int) $limit, 
            (int) $page, 
            $queryData, 
            $selectedFields, 
            $orderBy, 
            (boolean) $ascending
        );

        return parent::send($app, "DataService.query", $params);
    }
    
    public static function update($table, $id, $values, Infusionsoft_App $app = null){
        $params = array(
            $table, 
            (int) $id, 
            $values
        );

        return parent::send($app, "DataService.update", $params);
    }
    
    public static function getAppSetting($module, $setting, Infusionsoft_App $app = null){
        $params = array(
            $module, 
            $setting
        );

        return parent::send($app, "DataService.getAppSetting", $params);
    }
    
    public static function findByField($table, $limit, $page, $fieldName, $fieldValue, $selectedFields, Infusionsoft_App $app = null){
        $params = array(
            $table, 
            (int) $limit, 
            (int) $page, 
            $fieldName, 
            $fieldValue, 
            $selectedFields
        );

        return parent::send($app, "DataService.findByField", $params);
    }
    
    public static function authenticateUser($username, $passwordHash, Infusionsoft_App $app = null){
        $params = array(
            $username, 
            $passwordHash
        );

        return parent::send($app, "DataService.authenticateUser", $params);
    }
    
    public static function getTemporaryKey($vendorKey, $username, $passwordHash, Infusionsoft_App $app = null){
        $params = array(
            $vendorKey, 
            $username, 
            $passwordHash
        );

        return parent::send($app, "DataService.getTemporaryKey", $params);
    }
    
    public static function addCustomField($context, $displayName, $dataType, $groupId, Infusionsoft_App $app = null){
        $params = array(
            $context, 
            $displayName, 
            $dataType, 
            (int) $groupId
        );

        return parent::send($app, "DataService.addCustomField", $params);
    }
    
    public static function updateCustomField($customFieldId, $values, Infusionsoft_App $app = null){
        $params = array(
            (int) $customFieldId, 
            $values
        );

        return parent::send($app, "DataService.updateCustomField", $params);
    }
    
    public static function getAppointmentICal($appointmentId, Infusionsoft_App $app = null){
        $params = array(
            (int) $appointmentId
        );

        return parent::send($app, "DataService.getAppointmentICal", $params);
    }
    
}