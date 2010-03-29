<?php echo '<?php' . "\n"; ?>
class Infusionsoft_<?php echo $this->table; ?> extends Infusionsoft_Generated_<?php echo $this->table; ?>{	
    public function __construct(){
    	parent::__construct();
    	$this->fields = parent::$table_fields;
    	//Add custom fields here like this...
    	//$this->fields[] = 'CustomFieldName';
    }
}

