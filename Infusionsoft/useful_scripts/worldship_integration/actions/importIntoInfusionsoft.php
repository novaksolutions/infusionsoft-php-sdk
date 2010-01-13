<?php
	set_time_limit(60 * 60);
	ini_set('memory_limit', '64M');
	
	include('../../../infusionsoft_sdk.php');
	include('../classes/WorldShipIntegrationUtilities.php');
	include('../classes/FulfillmentUtilities.php');
	include('../config.php');
	
    // force to download a file #create connection        
    //Read the file...    
    if($_FILES['UPSExport']['name'] != ''){
    	$fhandle = fopen($_FILES['UPSExport']['tmp_name'], 'r');
    	//Get the headers first...
    	$headers = fgetcsv($fhandle);
    	$orderCount = 0;
    	while($line = fgetcsv($fhandle)){
    		$orderCount++;
    		//Get the order...
    		$DAO = new InfusionsoftOrderDAO();
    		$order = $DAO->getOneByField('Id', $line[0]);    					
			$order->_ShippingStatus = 'SHIPPED';
			$order->_UPSTrackingNumber = $line[1];
			$order->save();    		
    	}
		//Open the file, and look at csv stuff...
		$msg = $orderCount . ' orders updated with a Tracking Number.';    		
    }
    
    $orderCount = WorldShipIntegrationUtilities::getOrdersAwaitingImportCount();    
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">    
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta content="Information architecture, Web Design, Web Standards."
 name="Description" />
  <meta content="your, keywords" name="Keywords" />
  <meta content="text/html; charset=iso-8859-1"
 http-equiv="Content-Type" />
  <meta content="Global" name="Distribution" />
  <meta content="Erwin Aligam - ealigam@gmail.com" name="Author" />
  <meta content="index,follow" name="Robots" />
  <link type="text/css" href="../images/Envision.css" rel="stylesheet" />
  <title>Import Tracking Numbers</title>
</head>
<body>
<div id="wrap">
<div id="header">
<h1 id="logo-text"><?php echo $GLOBALS['company_name'];?></h1>
<p id="slogan">fulfillment
processing</p>
<br />
</div>

<div id="content-wrap">
	<h1><?php echo $orderCount; ?> Orders Awaiting Tracking Numbers</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="UPSExport">
		<input type="submit">
	</form>
</div>
<div id="footer">
<p> &copy; 2009 <strong>RoadWrap</strong> |
Design by:&nbsp;<a href="http://www.buyroadwrap.com">jordan hatch</a><a
 href="index.html">
</a></p>
</div>
</div>
</body>
</html>
