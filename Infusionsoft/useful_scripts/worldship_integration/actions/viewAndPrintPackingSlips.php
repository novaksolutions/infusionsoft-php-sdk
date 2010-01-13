<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Print Packing Slips</title>
		<style>
			.order-items{
				margin-top: 10px;
				margin-bottom: 10px;
			}
		</style>
	</head>
	<body>
<?php
	set_time_limit(60 * 60);
	ini_set('memory_limit', '64M');
	
	include("../config.php");
	include('../../../infusionsoft_sdk.php');
	include('../classes/WorldShipIntegrationUtilities.php');
	include('../classes/FulfillmentUtilities.php');	        
    
    #get orders from a specific date
    $returnFields = array('InvoiceId', 'ContactId', '_Exported', 'DateCreated', 'JobStatus');
    $orders = FulfillmentUtilities::getOrdersWithStatuses(array('~null~', 'EXPORTED', ''));        
      
    #only do all this if there are orders to process
    if(count($orders) != 0){
	    #Create array to hold the data
	    $orderRows = array($orderColumns);
	    
	       
	    #process 1 line per order
	    foreach($orders as $order){
	    	$contactReturnFields = array('FirstName', 'LastName', 'Company', 'StreetAddress1', 'StreetAddress2', 'City', 'State', 'PostalCode', 'Country', 'Email', 'Id');
	        $contact = $order->getContact($contactReturnFields);
	    	$orderItems = $order->getOrderItems();	    		        
	    	?>    	
            <table width="650px">
                <tbody>
                    <tr>
                        <td valign="top">
                         <img alt="" src="<?php echo $GLOBALS['company_logo_url']; ?>"><br>
                         
                        </td>
                        <td align="right" valign="top">
                         <h1>Packing Slip</h1>
                          <table  style="border:1px solid #000;" cellpadding="5" cellspacing="0">
                            <tbody>
                               <tr>
                                  <td style="border:1px solid #000;" align="center">Date</td>
                                  <td style="border:1px solid #000;" align="center">Order #</td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000;" align="center"><?php echo date('m-d-Y',strtotime($order->DateCreated)); ?></td>
                                    <td style="border:1px solid #000;" align="center"><?php echo $order->Id; ?></td>
                                </tr>
                            </tbody>

                        </table>
                        </td>
                    </tbody>
            </table>
                                
            <?php echo $GLOBALS['company_name'];?><br>
            <?php echo $GLOBALS['company_address1'];?><br>
            <?php if($GLOBALS['company_address2'] != ''){ echo $GLOBALS['company_address2'];?><br><?php } ?>
            <?php echo $GLOBALS['company_city'];?>, <?php echo $GLOBALS['company_state'];?> <?php echo $GLOBALS['company_zip'];?>            
            <table width="650px" border="1px" class="order-items">
            	<tr>
            		<td bgcolor="Black" colspan="99">
            			<font color="White" bgcolor="Black"><b>Order Items</b></font>
            		</td>
            	</tr>
            	<tr>	
            		<td align="center">Item Name</td>
            		<td align="center">Quantity</td>
            	</tr>
            	<?php
            	
               	foreach($orderItems as $orderItem){               		
               		?>               		
               		<tr style="border: 1px solid #000">
               			<td width="550px"><?php echo  $orderItem->ItemName; ?></td>
               			<td width="100px" align="right"><?php echo $orderItem->Qty; ?></td>
               		</tr>
               		<?php                              
                }
                ?>
            	</tr>            
            </table>    
            </tr>
            </tbody>
		</table>
                     
                  <?php echo $GLOBALS['packing_slip_footer'];?><br/>
                  <?php echo $GLOBALS['company_name'];?><br/>
                  <?php echo $GLOBALS['company_phone'];?><br/>                                   
  		
	<hr style="page-break-after: always; height: 0px;">
	<?php
    	}
    }        	    	
    else{
    	?>  
<div id="wrap">
<div id="header">
<h1 id="logo-text">RoadWrap</h1>
<p id="slogan">fulfillment
processing</p>
<br />
</div>
<div id="content-wrap"><br><h1>No Packing Slips To Process</h1><br><a href="javascript:window.close();"><h2>Click Here to Go Back</h2></a></div>
<div id="footer">
<p> &copy; 2009 <strong>RoadWrap</strong> |
Design by:&nbsp;<a href="http://www.buyroadwrap.com">jordan hatch</a><a
 href="index.html">
</a></p>
</div>
</div>
</body>
</html>
<?php 
    }
    ?>