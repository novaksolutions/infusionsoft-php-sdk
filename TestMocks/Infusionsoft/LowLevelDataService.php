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

    public function query($args){
        //Remove Api Key
        array_shift($args);
        return $this->data->query($args);
    }

    /**
     * @param $username
     * @param $password
     * There is no Users table we can check against, so it looks for Contacts with the "_User" field set to true
     */
    public function authenticateUser($args){
        array_shift($args);
        list($username, $password) = $args;
        $contacts = $this->data->query(array('Contact', 1000, 0, array('_User' => '1'), null));
        foreach ($contacts as $contact){
            if ($contact['Email'] == $username && md5($contact['Password']) == $password){
                return true;
            }
        }
        return false;
    }
}
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 3:11 AM
 * To change this template use File | Settings | File Templates.
 */