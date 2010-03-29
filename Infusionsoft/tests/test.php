<?php
include('infusionsoft_sdk.php');


$inf = new InfusionsoftApp();
?>
Testing Unauthenicated API Connection to: https://<?php echo $GLOBALS['infusionsoft_host']; ?><br />

<?php
if($inf->ping()){
	echo 'Success!!! - Everything appears to be working fine.<br/><br/>';
	
	echo 'Testing Authenticated API Connect by searching for Contact 1<br/>';
	$DAO = new InfusionsoftContactDAO();
	
	try{
		$data = $DAO->getOneByField('Id', -1);
	}
	catch(Exception $e){	
		if(strpos($e->error, "[InvalidKey]") !== FALSE){
			echo 'Failure!!! Your Key is not correct, please double check the key you put in the config.php with the APIKey in your apps Misc Settings.';
		}
		elseif(strpos($e->error, "[RecordNotFound]") !== FALSE){
			echo 'Success!!!  Everything is configured correctly and you should be able to use the API without connectivity problems.';
		}	
		else{
			echo 'Failure!!! Some other error: ' . $e->error;
		}
	}
		
}
else{
	echo 'Failure!!! - ' . $GLOBALS['infusionsoft_last_exception']->error;	
}


?>
