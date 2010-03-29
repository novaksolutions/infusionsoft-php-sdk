<?php
class DataServiceTableFields {
	public $fields = array();
	public function parseApiFieldAccessXML($filePath){
		if (!($dom = new DomDocument()))
		{
			throw new InfusionsoftException('Cannot create new DomDocument()');
			return FALSE;
		}

		$dom->load($filePath);
		foreach($dom->getElementsByTagName('table') as $table)
		{
			$this->fields[$table->getAttribute('name')] = array();
			foreach($table->getElementsByTagName('field') as $field)
			{
				$this->fields[$table->getAttribute('name')][] = $field->getAttribute('name');
			}
		}

	}
}

class StubGenerator{
	protected $fields = array();
	protected $table;
		
	public function __construct($table, $fields){
		$this->table = $table;
		$this->fields = $fields;		
	}	
	
	public function write($templatePath, $filePath){
		?>Writing source for table class: <?php echo $this->table; ?><br/><?php 
		ob_start();
		include($templatePath);
		$contents = ob_get_clean();
		$handle = fopen($filePath, 'w');
		fwrite($handle, $contents);
		fclose($handle);
		
		
		?><pre><?php echo htmlentities($contents); ?></pre><?php 
	}
	
	public function getFieldsAsArraySource(){
		$source = '';
		$source .= 'array(';
		$addedAField = false;
		foreach($this->fields as $field){
			if($addedAField){ 
				$source .= ', ';
			}	
			$source .= "'" . $field . "'";
			$addedAField = true;
		}				
		$source .= ')';
		return $source;
	}
}

$filePath = dirname(__FILE__) . '/misc/API_Field_Access.xml';
$fields = new DataServiceTableFields();
$fields->parseApiFieldAccessXML($filePath);
foreach($fields->fields as $table=>$fields){
	$stubGenerator = new StubGenerator($table, $fields);
	$stubGenerator->write(dirname(__FILE__) . '/generated/a_template_base_class.php', dirname(__FILE__) . '/generated/' . $table . '.php');

	$stubGenerator = new StubGenerator($table, array());
	if(!file_exists(dirname(__FILE__) . '/' . $table . '.php')){
		$stubGenerator->write(dirname(__FILE__) . '/generated/a_template_class.php', dirname(__FILE__) . '/' . $table . '.php');
	}
}

