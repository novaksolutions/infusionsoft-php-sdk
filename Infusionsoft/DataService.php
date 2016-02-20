<?php
class Infusionsoft_DataService extends Infusionsoft_DataServiceBase
{
    public static function ping($serviceName = 'DataService', Infusionsoft_App $app = null)
    {
        return parent::ping($serviceName, $app);
    }

    public static function addCustomField(Infusionsoft_Generated_Base &$object, $displayName, $dataType, $groupId, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        $params = array(
            $object->getTable(),
            $displayName,
            $dataType,
            (int) $groupId,
        );

        $customFieldId = $app->send('DataService.addCustomField', $params);
        return $customFieldId;
    }

    public static function delete(Infusionsoft_Generated_Base &$object, $id, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        $params = array(
            $object->getTable(),
            (int) $id
        );

        $records = $app->send('DataService.delete', $params, true);
    }

    public static function findByField($object, $field, $value, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        if(!$returnFields){
            $returnFields = $object->getFields();
        }

        $params = array(
            $object->getTable(),
            (int) $limit,
            (int) $page,
            $field,
            $value,
            $returnFields
        );

        $records = $app->send('DataService.findByField', $params, true);
        return self::_returnResults(get_class($object), $app->getHostName(), $records, $returnFields);
    }

    public static function getAppointmentICal($appointmentId, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
        (int) $appointmentId);

        $out = $app->send('DataService.getAppointmentICal', $params);

        return $out;
    }

    public static function getAppSetting($moduleName, $settingName, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
        $moduleName,
        $settingName);

        $out = $app->send('DataService.getAppSetting', $params, true);

        return $out;
    }

    /*
     * This is in the DataService.java file, but not exposed...
    public static function getMetaData(Infusionsoft_Generated_Base &$object, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        $params = array(
        $object->getTable());

        $arrayOfFields = $app->send('DataService.getMetaData', $params);

        return $arrayOfFields;
    }
    */

    public static function load(Infusionsoft_Generated_Base &$object, $id, $returnFields = false, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        if(!$returnFields){
            $object->removeRestrictedFields();
            $returnFields = $object->getFields();
            $object->addRestrictedFields();
        }

        $params = array(
            $object->getTable(),
            (int) $id,
            $returnFields
        );

        $records = $app->send('DataService.load', $params, true);
        return self::_returnResult(get_class($object), $app->getHostName(), $records);
    }

    public static function query($object, $queryData, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        if(!$returnFields){
            $returnFields = $object->getFields();
        }

        $params = array(
            $object->getTable(),
            (int) $limit,
            (int) $page,
            $queryData,
            $returnFields
        );

        $records = $app->send('DataService.query', $params, true);
        return self::_returnResults(get_class($object), $app->getHostName(), $records, $returnFields);
    }

    public static function count($object, $queryData, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        $params = array(
            $object->getTable(),
            $queryData
        );

        $count = $app->send('DataService.count', $params, true);
        return $count;
    }

    public static function queryWithOrderBy($object, $queryData, $orderByField, $ascending = true, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);

        if(!$returnFields){
            $returnFields = $object->getFields();
        }

        if(is_bool($ascending)){
            $ascending = $ascending && true;
        }

        $params = array(
            $object->getTable(),
            (int) $limit,
            (int) $page,
            $queryData,
            $returnFields,
            $orderByField,
            (bool) $ascending
        );

        $records = $app->send('DataService.query', $params, true);
        return self::_returnResults(get_class($object), $app->getHostName(), $records, $returnFields);
    }

    public static function search($object, $searchData, $queryData = array(), $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);
        $queryData = self::makeQueryFromSearch($searchData, $queryData);
        return self::query($object, $queryData, $limit, $page, $returnFields, $app);
    }

    public static function searchWithOrderBy($object, $orderByField, $searchData, $queryData = array(), $ascending = true, $limit = 1000, $page = 0, $returnFields = false, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);
        $queryData = self::makeQueryFromSearch($searchData, $queryData);
        return self::queryWithOrderBy($object, $queryData, $orderByField, $limit, $page, $returnFields, $app);
    }

    private static function makeQueryFromSearch($searchData, $queryData)
    {
        foreach ($searchData as $key => $searchString){
            $queryData[$key] = "%" . $searchString . "%";
        }
        return $queryData;
    }

    public static function save(Infusionsoft_Generated_Base &$object, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app, $object);
        $out = 0;

        if ($object->isEmpty()){
            throw new Infusionsoft_Exception(sprintf('Cannot save a blank %s record', $object->getTable()));
        }

        if($object->Id > 0){
            $params = array(
                $object->getTable(),
                (int) $object->Id,
                $object->toArray()
            );
            $out = $app->send('DataService.update', $params, true);
        }else{
            $params = array(
                $object->getTable(),
                $object->toArray()
            );
            $object->Id = $app->send('DataService.add', $params);
            $out = $object->Id;
        }

        return $out;
    }

    public static function updateCustomField($customFieldId, $arrayOfValues, Infusionsoft_App $app = null)
    {
        $app = parent::getObjectOrDefaultAppIfNull($app);

        $params = array(
        (int) $customFieldId,
        $arrayOfValues);
        $out = $app->send('DataService.updateCustomField', $params, true);

        return $out;
    }

    public static function getCustomFields($object, $app = null)
    {
        $fields = Infusionsoft_DataService::query(new Infusionsoft_DataFormField(), array('FormId' => $object->customFieldFormId), 1000, 0, false, $app);
        $returnData = array();
        foreach ($fields as $field){
            $field->Name = '_' . $field->Name;
            $returnData[$field->Name] = array($field);
        }
        $fields = $returnData;

        return $fields;
    }
}