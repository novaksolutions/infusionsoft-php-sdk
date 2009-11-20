<?php
	include("config.php");
	include("../../config.php");
	include("../../infusionsoft_sdk.php");
	include('classes/WorldShipIntegrationUtilities.php'); 
	include('classes/FulfillmentUtilities.php');
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
  <link type="text/css" href="images/Envision.css" rel="stylesheet" />
  <title><?php echo $GLOBALS['company_name']; ?> Order Fulfillment</title>
  <style>
  	.step-cell{
  		width: 220px;
  		text-align: center;
  	}
  </style>
</head>
<body>
<div id="wrap">
<div id="header">
<h1 id="logo-text"><?php echo $GLOBALS['company_name']; ?></h1>
<p id="slogan">fulfillment
processing</p>
<br />
</div>
<div id="content-wrap">
<h2>Welcome to the <?php echo $GLOBALS['company_name']; ?>
Fulfillment Processing Center</h2>
This will be a quick and easy process. &nbsp;Step 1 will be to
create the CSV file to import into UPS World Ship. &nbsp;Step 2 is
to create a document to print the packing slips. &nbsp;Step 3 will
be to mark the orders as exported inside Infusionsoft.<br />

<h1>You have: <?php echo count(WorldShipIntegrationUtilities::getOrdersNotMarkedAsSuccesfullyImportedYet(1000)); ?> Orders That Havn't Been Exported</h1>
<h3>Click on &nbsp;the first
link to get started.</h3>
<table style="text-align: left;" border="0" cellpadding="2"
 cellspacing="2">
  <tbody>
	<tr>
		<td colspan="99">
			<h1>Exporting Orders To UPS Worldship</h1>
		</td>
	</tr>
    <tr>
      	<td style="width: 220px; text-align: center;">
      		<h2>Step 1 - Excel File</h2>
      		<a href="actions/createCSVFile.php" target="_blank"><img style="width: 128px; height: 128px;" alt="" src="images/Excel128.png" /></a>
 		</td>
 		<td style="width: 220px; text-align: center;">
      		<h2>Step 2 - Mark Orders As Succesfully Exported To WorldShip</h2>
      		<a href="actions/createCSVFile.php" target="_blank"><img style="width: 128px; height: 128px;" alt="" src="images/check128.png" /></a>
 		</td>      
    </tr>
    
    <tr>
	    <td colspan="99">
	    	<h1>Print Packing Slips</h1> 
	    </td>
    </tr>
    <tr>
    	<td style="width: 220px; text-align: center;">
      		<h2>Step 3 - Packing Slips</h2>
      		<a href="actions/viewAndPrintPackingSlips.php" target="_blank"><img style="width: 128px; height: 128px;" alt="" src="images/Icon-printer.png" /></a>
      	</td>
      	<td style="width: 220px; text-align: center;">
      		<h2>Step 4 - Mark Orders As Printed</h2>
      		<a href="actions/markOrdersAsPrinted.php" target="_blank"><img style="width: 128px; height: 128px;" alt="" src="images/check128.png" /></a>
      	</td>
    </tr>    
    <tr>
	    <td colspan="99">
	    	<h1>Process Packages In UPS Worldship</h1> 
	    </td>
    </tr>
	<tr>
		<td colspan="99">
			<h1>Importing Tracking Numbers From UPS Worldship</h1>
		</td>
	</tr>
	<tr>		
	    <td colspan="10">
	    	<h2>There are: <?php echo WorldShipIntegrationUtilities::getOrdersAwaitingImportCount();?> Orders awaiting tracking numbers in Infusionsoft.</h2>
	    </td>	   
	</tr>
	<tr>
		<td class="step-cell">
			<h2>STEP 5 - Export From WorldShip</h2>					
			<a href="ups_setup.php" target="_blank"><img src="images/ups_logo.jpg" width="128"></a>
		</td>
		<td class="step-cell">
			<h2>STEP 6 - Import Into Infusionsoft</h2>
			<a href="actions/importIntoInfusionsoft.php"><img src="images/Infusionsoft.png" width="128"></a>
		</td>		
	</tr>
  </tbody>
</table>
<br />
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
