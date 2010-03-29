<?php
include("../include_me.php");

$webforms = Infusionsoft_WebFormService::getMap(Infusionsoft_AppPool::getApp());

foreach($webforms as $webformId=>$webformName){
	?>
	<h1>Webform: <?php echo $webformId . '-' . $webformName; ?></h1>	
	<?php
	echo Infusionsoft_WebFormService::getHtml(Infusionsoft_AppPool::getApp(), $webformId);
	?><hr><?php  	
}
?>