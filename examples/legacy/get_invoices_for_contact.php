<?php
    include('../infusionsoft.php');
    include('../tests/testUtils.php');
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
				<tr><td colspan="2" style="font-size:20;">New Invoice</td></tr>
				<?php 				
				foreach($invoice->getFields() as $field){
					?>
					<tr>
						<td><?php echo $field; ?></td>
						<td><?php echo $invoice->$field; ?></td>
					</tr>
					<?php
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