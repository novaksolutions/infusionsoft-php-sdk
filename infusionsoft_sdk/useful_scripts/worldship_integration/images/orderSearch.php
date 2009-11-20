<?php
    include 'isdk.php';
    
    #create connection    
    $myApp =new iSDK;
    if ($myApp->cfgCon("demo")) {
    } else {
        die("Failed to connect to Infusionsoft!");
    }
       
    #get orders from a specific date
    $returnFields = array('InvoiceId', 'ContactId', '_Exported', 'DateCreated');
    $query = array('_Exported' => 0);
    $invoice = $myApp->dsQuery("Job",1000,0,$query,$returnFields);
    
      
    #only do all this if there are orders to process
    if(count($invoice) != 0){
    #Create array to hold the data
    $orderRows = array($orderColumns);
    
    echo '<html><head><title>Order Export</title></head><body>';
       
    #process 1 line per order
    foreach($invoice as $key => $value){
        #display order Id
        #echo $invoice[$key]['Id'] . ",";
        $orderRows[$key]['OrderId'] = $invoice[$key]['InvoiceId'];
        
        #get Contact data for this order
        $contactReturn = array('FirstName', 'LastName', 'Company', 'StreetAddress1', 'StreetAddress2', 'City', 'State', 'PostalCode', 'Country', 'Email', 'Id');
        $contactQuery = array('Id' => $invoice[$key]['ContactId']);
        $contactData = $myApp->dsQuery("Contact",1,0,$contactQuery,$contactReturn);
        
        #display contact data for this order
        #echo $contactData[0]['FirstName'] . " " . $contactData[0]['LastName'] . "," . $contactData[0]['Company'] . "," . $contactData[0]['StreetAddress1'] . "," . $contactData[0]['StreetAddress2'] . "," . $contactData[0]['City'] . "," . $contactData[0]['State'] . "," . $contactData[0]['PostalCode'] . "," . $contactData[0]['Country'] . ",";
        
        $orderRows[$key]['ContactName'] = $contactData[0]['FirstName'] . " " . $contactData[0]['LastName'];
        $orderRows[$key]['Company'] = $contactData[0]['Company'];
        $orderRows[$key]['StreetAddress1'] = $contactData[0]['StreetAddress1'];
        $orderRows[$key]['StreetAddress2'] = $contactData[0]['StreetAddress2'];
        $orderRows[$key]['City'] = $contactData[0]['City'];
        $orderRows[$key]['State'] = $contactData[0]['State'];
        $orderRows[$key]['PostalCode'] = $contactData[0]['PostalCode'];
        $orderRows[$key]['Country'] = $contactData[0]['Country'];
        $orderRows[$key]['Email'] = $contactData[0]['Email'];
        $orderRows[$key]['CustomerId'] = $contactData[0]['Id'];
        
        #static Data
        $orderRows[$key]['BillingOption'] = 'tp';
        $orderRows[$key]['CompanyName'] = 'WorldClassConcepts';
        $orderRows[$key]['CompanyAddress'] = '2832 Virginia Street';
        $orderRows[$key]['CompanyCity'] = 'Kenner';
        $orderRows[$key]['CompanyState'] = 'LA';
        $orderRows[$key]['CompanyZip'] = '70062';
        $orderRows[$key]['AccountNumber'] = '9E2Y30';
        $orderRows[$key]['PackageType'] = 'Package';
        $orderRows[$key]['ShipNotification'] = 'Y';
        $orderRows[$key]['NotificationType'] = 'Y';
        $orderRows[$key]['ShippingMethod'] = 'ST';
        
        
        
        #get Order Items for this order
        $orderItemQuery = array ('OrderId' => $invoice[$key]['InvoiceId']);
        $orderItemReturn = array('ProductId', 'Qty', 'ItemName');
        $orderItems = $myApp->dsQuery("OrderItem",100,0,$orderItemQuery,$orderItemReturn);
        
        #this value gets added to each time the foreach loop runs and reset with the declaration below
        $orderWeight = 0;
        $shippingMethod = ' ';        
        $productWeightReturn = array('Weight');
       
        
        #calculate total weight of order
        #this runs as a separate loop to put the value in for the order total before it displays each individual item on the order
        #there are probably more elegant ways of doing this but this works :) 
        foreach($orderItems as $key3 => $value3){
            #connect the order item product Id to the product table and lookup the weight
            $orderItemWeight = $myApp->dsFind('Product',1,0,'Id',$orderItems[$key3]['ProductId'],$productWeightReturn);
            $orderItemQuantity = $orderItems[$key3]['Qty'];
            $orderItemWeightFloat = $orderItemWeight[0]['Weight'];
            settype($orderItemWeightFloat, "float");
            settype($orderItemQuantity, "float");
            $orderWeight = $orderItemWeightFloat * $orderItemQuantity + $orderWeight;
            $index = $key3+1;
            $orderRows[$key]['TotalWeight'] = $orderWeight;
            $orderRows[$key]['ShippingMethod'] = $shippingMethod;
            $orderRows[$key]["Item" . $index] = $orderItems[$key3]['ItemName'];
            $orderRows[$key]["Item" . $index . "Qty"] =  $orderItems[$key3]['Qty'];
            if($orderItems[$key3]['ItemName'] == 'UPS Overnight') $orderRows[$key]['ShippingMethod'] = '1DA';
            else if($orderItems[$key3]['ItemName'] == 'UPS Ground') $orderRows[$key]['ShippingMethod'] = 'ST';
            else if($orderItems[$key3]['ItemName'] == 'UPS 2nd Day') $orderRows[$key]['ShippingMethod'] = '2DA';
            else $orderRows[$key]['ShippingMethod'] = 'ST';
        }
    }
    
       
    $fp = fopen('file.csv', 'w');
    $headerNames = array("OrderId","ContactName","Company","Street1","Street2","City","State","Zip","Country","Email","CustomerId","BillingOption","CompanyName","CompanyAddress","CompanyCity","CompanyState","CompanyZip","AccountNumber","PackageType","ShipNotification","NotificationType","ShippingMethod", "TotalWeight","Item1","Item1Qty","Item2","Item2Qty","Item3","Item3Qty","Item4","Item4Qty","Item5","Item5Qty","Item6","Item6Qty","Item7","Item7Qty","Item8","Item8Qty","Item9","Item9Qty","Item10","Item10Qty"
    );
    fputcsv($fp, $headerNames);
    foreach($orderRows as $key => $value){
        fputcsv($fp, $orderRows[$key]);
    }
    fclose($fp);
	header('Content-disposition: attachment; filename=file.csv');
	header('Content-type: text/plain');
	readfile('file.csv');

    }
    else echo "No Orders to process!";
?>


