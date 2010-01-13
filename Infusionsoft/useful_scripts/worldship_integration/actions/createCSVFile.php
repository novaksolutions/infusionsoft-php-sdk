<?php
	set_time_limit(60 * 60);
	ini_set('memory_limit', '64M');
	
	include('../../../infusionsoft_sdk.php');
	include('../classes/WorldShipIntegrationUtilities.php');
	include('../classes/FulfillmentUtilities.php');
    // force to download a file #create connection        
    
    $orders = WorldShipIntegrationUtilities::getOrdersNotMarkedAsSuccesfullyImportedYet(50);    
    //var_dump($orders);
    #only do all this if there are orders to process    
    if(is_array($orders) && count($orders) != 0){
    	$packages = createPackages($orders);
    	FulfillmentUtilities::setOrdersShippingStatus($orders, 'EXPORTED');	    		        
	    returnCSVFileToBrowser($packages);	    
    }
    elseif(!is_array($orders)){
    	echo 'There was an error: ' . $orders;
    }
    else{
    	displayNoOrdersPage();
    }    
        
    
    function returnCSVFileToBrowser($orderRows){
    	$file_name = '../tmp/PackagesExport.csv';  
	    $fp = fopen($file_name, 'w');
	    $headerNames = array("OrderId","ContactName","Company","Street1","Street2","City","State","Zip","Country","Email","CustomerId","BillingOption","CompanyName","CompanyAddress","CompanyCity","CompanyState","CompanyZip","AccountNumber","PackageType","ShipNotification","NotificationType","BillTransportationTo", "ShippingMethod", "SignatureRequired", "TotalWeight","Item1","Item1Qty","Item2","Item2Qty","Item3","Item3Qty","Item4","Item4Qty","Item5","Item5Qty","Item6","Item6Qty","Item7","Item7Qty","Item8","Item8Qty","Item9","Item9Qty","Item10","Item10Qty");
	    
	    fputcsv($fp, $headerNames);	    	    
	    foreach($orderRows as $key => $value){	    	
	        fputcsv($fp, $orderRows[$key]);
	    }
	    	    	
        fclose($fp);        
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:  application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".basename($file_name));
        header("Content-Description: File Transfer");        
        @readfile($file_name);        
    }   
    
function createPackages($orders){
	$packages = array();	
	foreach($orders as $order){	   
		$packages = array_merge(createPackagesForOrder($order), $packages); 		       	   		
	}	
    return $packages;
}
    
function createPackagesForOrder($order){
	$myPackages = array();
		
	$orderItems = $order->getOrderItems(array('ProductId', 'Qty', 'ItemName'));
	$contact = $order->getContact(array('FirstName', 'LastName', 'Company', 'StreetAddress1', 'StreetAddress2', 'City', 'State', 'PostalCode', 'Country', 'Email', 'Id'));	           
    $packagesToCreate = array();
        
    $packagesToCreate[0] = $orderItems;
    foreach($packagesToCreate as $orderItems){
        $packageWeight = 0;
        $packageItems = array();
        
        foreach($orderItems as $orderItem){	                      
            $product = $orderItem->getProduct();            
            $orderItemWeight = $product->Weight * $orderItem->Qty;
            $packageWeight += $orderItemWeight;
            $packageItems[] = array('Item' => $orderItem->ProductId, 'Qty' => $orderItem->Qty);
        }
	        	             
        $orderItemQuantity = $orderItem->Qty;
        $orderItemWeightFloat = $orderItemWeight[0]['Weight'];
        settype($orderItemWeightFloat, "float");
        settype($orderItemQuantity, "float");
        $orderWeight = $orderItemWeightFloat * $orderItemQuantity + $orderWeight;
        
            
        $package = array();
        $package['OrderId'] = $order->Id;	                
	    $package['ContactName'] = $contact->FirstName . " " . $contact->LastName;
	    $package['Company'] = $contact->Company;
	    $package['StreetAddress1'] = $contact->StreetAddress1;
	    $package['StreetAddress2'] = $contact->StreetAddress2;
	    $package['City'] = $contact->City;
	    $package['State'] = strtoupper($contact->State);
	    $package['PostalCode'] = $contact->PostalCode;
	    $package['Country'] = $contact->Country;
	    $package['Email'] = $contact->Email;
	    $package['CustomerId'] = $contact->Id;
	        	
	    $package['BillingOption'] = 'tp';
	    $package['CompanyName'] = 'WorldClassConcepts';
	    $package['CompanyAddress'] = '2832 Virginia Street';
	    $package['CompanyCity'] = 'Kenner';
	    $package['CompanyState'] = 'LA';
	    $package['CompanyZip'] = '70062';
	    $package['AccountNumber'] = '9E2Y30';
	    $package['PackageType'] = 'Package';
	    $package['ShipNotification'] = 'Y';
	    $package['NotificationType'] = 'Y';
	    $package['BillTransportationTo'] = 'Shipper';
	    $package['ShippingMethod'] = $GLOBALS['worldship_UPSServiceType'];       
		$package['SignatureRequired'] = $GLOBALS['worldship_RequireSignature'];
		/*	     
        if($orderItem->ItemName == 'UPS Overnight') $package['ShippingMethod'] = '1DA';
        else if($orderItem->ItemName == 'UPS Ground') $package['ShippingMethod'] = 'ST';
        else if($orderItem->ItemName == 'UPS 2nd Day') $package['ShippingMethod'] = '2DA';
        else $package['ShippingMethod'] = 'ST';
        */            
        $myPackages[] = $package;
    }                
	return $myPackages;
}

function displayNoOrdersPage(){
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
  <title>RoadWrap Order Fulfillment</title>
</head>
<body>
<div id="wrap">
<div id="header">
<h1 id="logo-text">RoadWrap</h1>
<p id="slogan">fulfillment
processing</p>
<br />
</div>
<div id="content-wrap"><br><h1>No Invoices To Process</h1><br><a href="javascript:window.close();"><h2>Click Here to Go Back</h2></a></div>
<div id="footer">
<p> &copy; 2009 <strong>RoadWrap</strong> |
Design by:&nbsp;<a href="http://www.buyroadwrap.com">jordan hatch</a><a
 href="index.html">
</a></p>
</div>
</div>
</body>
</html><?php	
}    

