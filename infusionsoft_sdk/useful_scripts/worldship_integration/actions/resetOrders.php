<?php

    include 'isdk.php';
    // force to download a file #create connection    
    $myApp = new iSDK;
    if ($myApp->cfgCon("demo")) {
    } else {
        die("Failed to connect to Infusionsoft!");
    }
    
    #get orders 
    $returnFields = array('InvoiceId', 'ContactId', '_Exported0', 'DateCreated', 'OrderStatus', 'JobStatus', 'JobNotes');
    $query = array('JobStatus' => 'Shipped');
    $invoice = $myApp->dsQuery("Job",1000,0,$query,$returnFields);
    
    foreach($invoice as $key => $value){
        $myApp->dsUpdate("Job", $invoice[$key]['InvoiceId'], array('JobStatus'=> 'Quote'));   
    }
    echo $key . ' Orders were updated!';
?>