<?php
include("../infusionsoft.php");
include('testUtils.php');
$app = Infusionsoft_AppPool::getApp();
?>
Testing Host <?php echo $app->getHostname() . ':' . $app->getPort();?> with API Ping.
<br />
<?php 
if(Infusionsoft_DataService::ping()){
	?>
&nbsp;&nbsp;Ping Succeeded!!<br/><br/>Testing your API Key: by calling WebFormService.getMap. <br/>
	<?php
	try 	{

		Infusionsoft_WebFormService::getMap(Infusionsoft_AppPool::getApp());
		?>&nbsp;&nbsp;It Works!  Everything is communicating properly and your API Key is correct.<?php
	}
	catch(Exception $e){
		if(strpos($e->getMessage(), "[InvalidKey]") !== FALSE){
			echo '&nbsp;&nbsp; Failure!!! Your Key is not correct, please double check the key you put in the config.php with the APIKey in your apps Misc Settings.';
		}		
		else{
			echo '&nbsp;&nbsp; Failure!!! Some other error: ' . $e->error;
		}
	}
}
else{
	?>
Something is wrong, see below for details, check your config file and
try again.
	<?php
}
?>
<br />
<br />

<?php
$exceptions = Infusionsoft_AppPool::getApp()->getExceptions();
foreach($exceptions as $exception){
	echo $exception->getMessage();
	?>
<br />
	<?php
}
