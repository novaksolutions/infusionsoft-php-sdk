<?php
class Infusionsoft_LowLevelDataService extends Infusionsoft_LowLevelMockService{

    public function update($args){
        //Remove Api Key
        array_shift($args);
        return $this->data->update($args);
    }

    public function add($args){
        //Remove Api Key
        array_shift($args);
        return $this->data->add($args);
    }

    public function delete($args){
        //Remove Api Key
        array_shift($args);
        $this->data->delete($args);
    }

    public function load($args){
        //Remove Api Key
        array_shift($args);
        list($table, $id, $returnFields) = $args;
        $limit = 1;
        $page = 0;
        $queryData = array('Id' => $id);
        $matchingArrays = $this->data->query(array($table, $limit, $page, $queryData, $returnFields));
        $item = array_shift($matchingArrays);
        return $item;
    }
}
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 3:11 AM
 * To change this template use File | Settings | File Templates.
 */