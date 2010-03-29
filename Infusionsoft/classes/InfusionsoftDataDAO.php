<?php
class InfusionsoftDataDAO extends InfusionsoftBaseDAO{
	public function __construct($table){
		parent::__construct($table, str_replace('DAO', '', get_class($this)));
	}

	public function save($data){
		$out = 0;

		if ($data->fields_are_blank($data->toArray())){
			throw new InfusionException(sprintf('Cannot save a blank %s record', $this->_table));
		}

		if($data->Id > 0){			
			$params = array($GLOBALS['InfusionsoftApp']->api_key,
			$this->_table,
			$data->Id,
			$data->toArray());
			$out = $GLOBALS['InfusionsoftApp']->send('DataService.update', $params);			
		}
		else{
			$params = array($GLOBALS['InfusionsoftApp']->api_key,
			$this->_table,
			$data->toArray());

			$data->Id = $GLOBALS['InfusionsoftApp']->send('DataService.add', $params);
		}

		return $out;
	}

	
	 
	public function query($query, $returnFields = false, $limit = 1000, $page = 0){
		$fieldsToReturn = $this->_getFieldsToReturn($returnFields);
		$params = array($GLOBALS['InfusionsoftApp']->api_key,
		$this->_table,
		$limit,
		$page,
		$query,
		$fieldsToReturn);

		$records = $GLOBALS['InfusionsoftApp']->send('DataService.query', $params);
		return $this->_returnResults($records);
	}
	
	public function getOneByField($field, $value, $returnFields = false){
		$results = $this->getByField($field, $value, $resturnFields);		
		if(count($results) > 0){
			return $results[0];
		}
		else{
			return null;
		}
	}
}