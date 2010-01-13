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
<h2>UPS Worldship Setup</h2>
<p>
	I want to say "This will be a piece of cake." but I won't lie and it's not.  But, it will be fairly straightforward and not difficult.
	
	There are two steps.  First, creating the import mapping in Infusionsoft, Second creating the Export mapping.
	
	<b>These instructions are for UPS WorldShip v 11.0  Other versions should also work, however some steps are likely to differ.</b>
</p>
<h1>Step 1 - Creating The Import Map</h1>
<p>UPS Worldship is extremely flexible and versatile, because of this there are lots of options to setup. We recommend you print this, get out a pencil and mark off these steps as you complete them.</p>
<ul>	
	<li>Pre-Requsites
		<ul>
			<li>Create an export to be imported to WorldShip, and use the default name "PackagesExport.csv" you need this file before setting up WorldShip</li>
			<li>Place this file in your "My Documents" folder.</li>
			<li>Install Worldship and run through the setup wizard until you are at the main screen.</li>
						
		</ul>
	</li>
	
	<li>Create the ODBC Connection For The CSV File
		<ul>
			<li>If it's not open, open WorldShip</li>
			<li>Goto "Import/Export Data"->Connection Assistant</li>
			<li>Click "Create a new map for Import" and Click "Next"</li>
			<li>Under "Import Data Types" select "Shipment" (it's the last one)</li>
			<li>Click "Next"</li>
			<li>Click "By File" (middle, on the left)</li>
			<li>Click "Browse"</li>
			<li>At the bottom, right of "Files of type:" select "Text Files (*.txt, *.csv)"</li>
			<li>Navigate to and select the file you exported in step 1 (MyDocuments\PackagesExport.csv) and click "Open"</li>
			<li>Under ODBC Drivers, select "Microsoft Text Driver (*.txt, *.csv)</li>
			<li>In the top right, under "Data Source Name" type "Infusionsoft Import"</li>
			<li>Click "Next"</li>
			<li>Select "New Map"</li>
			<li>Enter "Infusionsoft Import" under "New Map Name:"</li>
			<li>Click "Next"</li>
			<li>Click "Finish"</li>
			<li>If an ODBC Setup window pops up, click "OK".</li>
		</ul>
	</li>
	
	<li>
		Create the Import Map
		<ul>
			<li>You should now be looking at a window that is titled "Edit 'Infusionsoft Import' import map</li>
			<li>In the drop down list under "ODBC Tables" select "PackagesExport.csv"</li>
			<li>Now we are going to map the fields from the file, to fields that WorldShip knows how to use.  Some of the fields that were exported will not be used, don't worry about them.</li>
			<li>Ship To Fields
				<ul>
					<li>On the right side at the top, underneath "WorldShip Fields" select "Ship To"</li>
					<li>On the left hand side, select "ContactName" on the right side, select "Company or Name" now click "Connect"</li>
					<li>Repeat the above steps to "Connect" the following fields together.</li>
					<li>Company -> Attention</li>
					<li>Street1 -> Address1</li>
					<li>Street2 -> Address2</li>
					<li>City -> "City or Town"</li>
					<li>State -> "State / Province / County"</li>
					<li>Zip -> "Postal Code"</li>
					<li>Country -> "Country/Territory"</li>
					<li>Email -> "Email Address"</li>					
				</ul>
			</li>
			<li>
				Shipment Information Fields
				<ul>
					<li>On the right side at the top, underneath "WorldShip Fields" select "Shipment Information"</li>
					<li>Total Weight -> Actual Weight</li>
					<li>BillTransportationTo -> Bill Transportation To</li>
					<li>BillingOption -> Billing Option</li>
					<li>ShipNotification -> QVN Ship Notification (You can skip this one if you don't want UPS Quantum View to send your customers tracking info via email)</li>
					<li>ShippingMethod -> Service Type</li>
					
				</ul>
			</li>
			<li>
				Package Information Fields
				<ul>
					<li>On the right side at the top, underneath "WorldShip Fields" select "Package Information"</li>
					<li>Package Type -> Package Type</li>
					<li>OrderId -> Reference 1</li>
					<li>CustomerId -> Reference 2</li>
					<li>SignatureRequired -> Delivery Confirmation Signature Required</li>					
				</ul>
			</li>
		</ul>
	</li>
	</ul>
	<h1>Step 2 - Create the Export Map</h1>
	<ul>
	<li>Create The Export ODBC Connection For The Export CSV File
		<ul>
			<li>Open Notepad, and save an empty file to (My Documents/export.csv).  When you save it, you MUST put quotes around export.csv, or else it saves it as export.csv.txt.</li>
			<li>From the home WorldShip screen select "Import/Export Data"->"ConnectionAssistant"</li>
			<li>Create a new map for Export</li>
			<li>Under Export Data Types select "Shipment"</li>
			<li>Click "Next"</li>
			<li>Click "By File"</li>
			<li>Click "Browse" select the empty file you created above (My Documents/export.csv).</li>
			<li>Under "Data Source Name" enter "Infusionsoft Export"</li>
			<li>Under "ODBC Drivers" select "Microsoft Text Driver (*.txt, *.csv)"</li>
			<li>Click "Next"</li>
			<li>Click "New Map"</li>
			<li>Under "New Map Name:" enter "Infusionsoft Export"</li>
			<li>Click "Next"</li>
			<li>Click "Finished"</li>
			<li>If an ODBC window appears click "Ok"</li>
		</ul>
	</li>
	<li>Create The Export Map
		<ul>			
			<li>You should now be looking at a window titled "Edit 'Infusionsoft Export' export to CSV map</li>
			<li>On the left side, click the "Package" tab.</li>
			<li>Scroll down, and click on "Reference 1"</li>
			<li>At the bottom of the window, click "Add"</li>
			<li>On the very bottom there is a yellow field with highlighted text in it (to the left of the "Rename" button, put "OrderId" in this field.</li>
			<li>Now click "Rename"</li>
			<li>Now, on the left side click the "Tracking Number" field, click "Add" and rename it to "PackageTrackingNumber"</li>
			<li>Now, on the left side click the "Reference 2" field, click "Add" and rename it to "CustomerId"</li>
			<li>Click OK</li>			
		</ul>
	</li>
	<li>Congratulations!  You are ready to use this awesome tool!</li>	
</ul>

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
