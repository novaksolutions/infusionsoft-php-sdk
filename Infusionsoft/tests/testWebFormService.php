<?php
include("../infusionsoft.php");
include('testUtils.php');

$webforms = Infusionsoft_WebFormService::getMap(Infusionsoft_AppPool::getApp());

foreach($webforms as $webformId=>$webformName){
	?>
	<h1>Webform: <?php echo $webformId . '-' . $webformName; ?></h1>	
	<?php
	echo Infusionsoft_WebFormService::getHTML($webformId, Infusionsoft_AppPool::getApp());
	?><hr><?php  	
}
?>