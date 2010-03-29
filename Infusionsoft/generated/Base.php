<?php
class Infusionsoft_Generated_Base{
	protected $fields;
	protected $table;
	protected $data;
	protected $appKey;
	
	public function getTable(){
		return $this->table;
	}

	public function getFields(){
		return $this->fields;
	}

	public function loadFromArray($data){
		foreach ($this->fields as $field){
			$this->$field = NULL;
			if ($data && is_array($data) && isset($data[$field])){
				$this->$field = $data[$field];					
			}
		}
	}
	
	public function loadFromObject($data){
		foreach ($this->fields as $field){
			$this->$field = NULL;
			if ($data && is_object($data) && isset($data->$field)){
				$this->$field = $data->$field;
			}
		}			
	}
	
	public function __set($name, $value){
		if($this->isValidField($name)){
			$this->data[$name] = $value;
		}
		else{
			throw new Exception("Invalid Field Name: " + $name);
		}
	}
	
	public function __get($name){
		if($this->isValidField($name)){
			return $this->data[$name];
		}
		else{
			throw new Exception("Invalid Field Name: " + $name);
			return '';
		}
	}
	
	public function isValidField($name){
		return in_array($name, $this->fields);
	}
	
	public function setAppKey($appKey){
		$this->appKey = $appKey;
	}
}
?>