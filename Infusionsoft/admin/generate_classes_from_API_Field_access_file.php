<html>
<body>
	
<?php
if($_SERVER['HTTP_HOST'] == 'sdk.novaksolutions.com'){
    echo "Sorry, we've disabled this on our server for security...";
    die();
}
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

$filePath = dirname(__FILE__) . '/API_Field_Access.xml';
$fields = new DataServiceTableFields();
$fields->parseApiFieldAccessXML($filePath);

$tables = array();

foreach($fields->fields as $table=>$fields){
	$stubGenerator = new StubGenerator($table, $fields);
	$stubGenerator->write(dirname(dirname(__FILE__)) . '/generated/a_template_base_class.php', dirname(dirname(__FILE__)) . '/generated/' . $table . '.php');

	
	if(!file_exists(dirname(dirname(__FILE__)) . '/' . $table . '.php') || isset($_GET['overwriteUserEditable'])){
		$stubGenerator = new StubGenerator($table, array());
		$stubGenerator->write(dirname(dirname(__FILE__)) . '/generated/a_template_class.php', dirname(dirname(__FILE__)) . '/' . $table . '.php');
	}
	
	$tables[] = $table;
}

$handle = fopen(dirname(dirname(__FILE__)) . "/examples/object_editor_all_tables.php", "w");
fwrite($handle, "<?php \$all_tables = " . var_export($tables, true) . ";");
fclose($handle);

?>

<a href="?overwriteUserEditable" onClick="return confirm('Are you sure you want to overwrite your changes to the Infusionsoft Data Classes?\n\nThis will ERASE ANY changes you\'ve made to the generated classes, and their user editable counterparts.');">Overwrite User Editable Classes (THIS IS FOR SDK DEVELOPERS ONLY!)</a>
	<br/>
	<br/>
	
	
</body>
</html>