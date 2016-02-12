<?php

/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 2:44 AM
 * To change this template use File | Settings | File Templates.

 */

class Infusionsoft_AppData {
    public $templatesSent = array();
    protected $tables = array();
    protected $contactApiGoalsAchieved = array();
    protected $emailOptStatus = array();
    public $fileBoxData = array();

    public function clearAll(){
        $this->tables = array();
        $this->fileBoxData = array();
    }

    public function query($params){
        list($table, $limit, $page, $queryData, $returnFields) = $params;
        $this->createTableIfNotExists($table);
        $results = array();

        foreach($this->tables[$table] as $row){
            $include = true;
            foreach($queryData as $fieldName => $fieldValue){
                if(
                    (!isset($row[$fieldName]) || !$this->emulateMySqlLike($fieldValue, $row[$fieldName]))&&
                    !(!isset($row[$fieldName]) && $fieldValue == '~null~')
                ){
                   $include = false;
                }
            }
            if($include){
                foreach ($row as $field => $value){
                    if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/", $value)){
                        $row[$field] = Infusionsoft_App::formatDate($value);
                    }
                }
                $results[] = $row;
            }
        }

        $resultPages = array();
        $pageNumber = 0;
        foreach ($results as $result) {
            $resultPages[$pageNumber][] = $result;
            if(count($resultPages[$pageNumber]) == $limit) {
                $pageNumber++;
            }
        }

        if(!array_key_exists($page, $resultPages)) {
            return array();
        }

        return $resultPages[$page];
    }

    public function add($params){
        list($table, $data) = $params;
        $this->createTableIfNotExists($table);
        foreach ($data as $field => $value){
            if (preg_match("/^[0-9]{8}T/", $value)){
                $data[$field] = date('Y-m-d H:i:s', strtotime($value));
            } else {
                $data[$field] = htmlspecialchars($data[$field]);
            }
        }
        $this->tables[$table][] = $data;
        end($this->tables[$table]);
        $index = key($this->tables[$table]);
        foreach ($this->tables[$table] as $index => $record){
            if (isset($record['Id']) && (!isset($maxId) || $record['Id'] > $maxId)){
                $maxId = $record['Id'];
            }
        }
        if (empty($maxId)){
            $maxId = 0;
        }
        $newId = $maxId + 1;
        $this->tables[$table][$index]['Id'] = $newId;
        return $newId;
    }

    public function update($params, $ignoreReadOnly = false){
        list($table, $id, $data) = $params;
        if(!$ignoreReadOnly && $table == 'Contact' && array_key_exists('Groups', $data)){
            unset($data['Groups']);
        }

        $this->createTableIfNotExists($table);
        foreach ($data as $field => $value){
            if (preg_match("/^[0-9]{8}T/", $value)){
                $data[$field] = date('Y-m-d H:i:s', strtotime($value));
            } else {
                $data[$field] = htmlspecialchars($data[$field]);
            }
        }
        foreach($this->tables[$table] as $index => &$row){
            if(isset($row['Id']) & $row['Id'] == $id){
                $this->tables[$table][$index] = array_merge($row, $data);
                return true;
            }
        }

        $this->tables[$table][] = $data;
        return true;
    }

    public function delete($params){
        list($table, $id) = $params;
        $this->createTableIfNotExists($table);
        foreach($this->tables[$table] as $index => &$row){
            if(isset($row['Id']) & $row['Id'] == $id){
                unset($this->tables[$table][$index]);
                break;
            }
        }
    }

    public function achieveGoal($integrationName, $goalName, $contactId){
        if(!isset($this->contactApiGoalsAchieved[$contactId])){
            $this->contactApiGoalsAchieved[$contactId] = array();
        }

        $this->contactApiGoalsAchieved[$contactId][] = "$integrationName/$goalName";
    }

    public function getAchievedGoals($contactId){
        if(!isset($this->contactApiGoalsAchieved[$contactId])){
            $this->contactApiGoalsAchieved[$contactId] = array();
        }

        return $this->contactApiGoalsAchieved[$contactId];
    }

    public function optInEmail($email, $reason){
        $this->emailOptStatus[$email] = true;
    }

    public function optOutEmail($email, $reason){
        $this->emailOptStatus[$email] = false;
    }

    private function createTableIfNotExists($tableName){
        if(!isset($this->tables[$tableName])){
            $this->tables[$tableName] = array();
        }
    }


    /**
     * Below code by andrewtch - https://github.com/andrewtch/phpwildcard
     */
    private function emulateMySqlLike($pattern, $value){
        return $this->wildcard_match(str_replace('%', '*', $pattern), $value);
    }

    private function wildcard_match($pattern, $value){
        //split patters by *? but not \* \?
        $pattern = preg_split('/((?<!\\\)\*)|((?<!\\\)\?)/', $pattern, null,
                PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);

        foreach($pattern as $key => $part) {
            if($part == '?') {
                $pattern[$key] = '.';
            } elseif ($part == '*') {
                $pattern[$key] = '.*';
            } else {
                $pattern[$key] = preg_quote($part, '/');
            }
        }

        $pattern = implode('', $pattern);

        $pattern = '/'.$pattern.'/s';

        return preg_match($pattern, $value);
    }

    public function getObjectById($tableName, $id){
        return array_shift($this->query(array($tableName, 1,0,array('Id' => $id), array())));
    }
}