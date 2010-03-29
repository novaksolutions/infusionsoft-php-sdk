<?php echo '<?php' . "\n"; ?>
class Infusionsoft_Generated_<?php echo $this->table; ?> extends Infusionsoft_Generated_Base{
    protected static $table_fields = <?php echo $this->getFieldsAsArraySource(); ?>;
    
    public function __construct(){
    	$this->table = '<?php echo $this->table; ?>';
    }
}
