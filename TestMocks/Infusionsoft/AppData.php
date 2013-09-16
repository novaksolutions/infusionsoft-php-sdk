<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 2:44 AM
 * To change this template use File | Settings | File Templates.
 */

class Infusionsoft_AppData {
    protected $tables = array();
    protected $contactApiGoalsAchieved = array();

    public function query($params){
        list($table, $limit, $page, $queryData, $returnFields) = $params;
        $this->createTableIfNotExists($table);
        $results = array();

        foreach($this->tables[$table] as $row){
            $include = true;
            foreach($queryData as $fieldName => $fieldValue){
                if(!isset($row[$fieldName]) || !$this->emulateMySqlLike($fieldValue, $row[$fieldName])){
                   $include = false;
                }
            }
            if($include){
                $results[] = $row;
            }
        }
        return $results;
    }

    public function add($params){
        list($table, $data) = $params;
        $this->createTableIfNotExists($table);
        $this->tables[$table][] = $data;
        end($this->tables[$table]);
        $index = key($this->tables[$table]);
        $this->tables[$table][$index]['Id'] = $index + 1;
        return $index + 1;
    }

    public function update($params){
        list($table, $id, $data) = $params;
        $this->createTableIfNotExists($table);
        foreach($this->tables[$table] as $index => &$row){
            if(isset($row['Id']) & $row['Id'] == $id){
                $row = array_merge($row, $data);
                break;
            }
        }
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
                $pattern[$key] = preg_quote($part);
            }
        }

        $pattern = implode('', $pattern);

        $pattern = '/^'.$pattern.'$/';

        return preg_match($pattern, $value);
    }
}