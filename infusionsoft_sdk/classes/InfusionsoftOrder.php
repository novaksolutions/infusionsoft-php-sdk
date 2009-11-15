<?php
class InfusionsoftOrder extends InfusionsoftData{
	public function __construct($infusionsoft_app, $initial_data = false){		
		parent::__construct($infusionsoft_app, "Job", $initial_data);		
	}
}
?>
