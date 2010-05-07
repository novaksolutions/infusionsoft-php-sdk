<?php
include('../infusionsoft.php');
include('testUtils.php');

?>
<html>
	<body>
		<form method="post">					
			ContactId: <input type="text" name="ContactId" value="<?php if(isset($_POST['ContactId'])) echo $_POST['ContactId']; ?>"><br/>			
			<input type="submit"/>
		</form>
			
	<?php		
		
		if(isset($_POST['ContactId'])){			
			$invoices = getInvoicesForContact($_POST['ContactId']);
			if(count($invoices) == 0){
				?><br/>No Invoices Found<?php	
			}  
			?><table><?php 			
			foreach($invoices as $invoice){
				?>
				<tr><td colspan="99" style="font-size:20; font-decoration: bold">New Invoice</td></tr>		
				<tr>
					<td></td>
					<td>Id: </td>
					<td><?php echo $invoice->Id; ?></td>						
				</tr>					
				<?php
				
				$invoicePayments = Infusionsoft_DataService::findByField(new Infusionsoft_InvoicePayment(), 'InvoiceId', $invoice->Id);
				$payments = array();
				foreach($invoicePayments as $invoicePayment){
					$somePayments = Infusionsoft_DataService::findByField(new Infusionsoft_Payment(), 'Id', $invoicePayment->PaymentId);
					$payments = array_merge($payments, $somePayments);											
				}
				if(count($payments) == 0){
					?>
						<tr>
							<td></td>
							<td colspan="99" style="font-size:20; font-decoration: bold">No Payments For This Invoice</td>
						</tr>	
					<?php 
				}
				foreach($payments as $payment){
					?>
					<tr><td></td><td colspan="99" style="font-size:20; font-decoration: bold">Payment</td></tr>
							
					<tr>
						<td></td>
						<td>PayAmt: </td>
						<td><?php echo $payment->PayAmt; ?></td>						
					</tr>	
					<?php 
					$cCharges = Infusionsoft_DataService::findByField(new Infusionsoft_CCharge(), 'Id', $payment->ChargeId);
					if(count($cCharges) > 0){
						$cCharge = $cCharges[0];
						
						?>	
						<tr><td></td><td colspan="99" style="font-size:20; font-decoration: bold">CCharge</td></tr>
						<tr>
							<td></td>
							<td>RefNum: </td>
							<td><?php echo $cCharge->RefNum; ?></td>						
						</tr>
						<?php
						
					}					
					else{
						?>
						<tr><td colspan="4">No CCharges Found For This Payment</td></tr>
						<?php 
					}					 					
				}													
			}	
			?></table><?php 	
		}
		
		function getInvoicesForContact($contactId){			
			$invoices = Infusionsoft_DataService::findByField(new Infusionsoft_Invoice(), 'ContactId', $contactId);
			return $invoices;
		}
		?>
	</body>
</html>