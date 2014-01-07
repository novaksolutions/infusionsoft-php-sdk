<?php
include('../infusionsoft.php');
include('testUtils.php');

?>
<html>
	<body>
		<form method="post">					
			ContactId: <input type="text" name="ContactId" value="<?php if(isset($_POST['ContactId'])) echo $_POST['ContactId']; ?>"><br/>			
			Integration Name: <input type="text" name="IntegrationName" value="<?php if(isset($_POST['IntegrationName'])) echo $_POST['IntegrationName']; ?>"><br/>
			Goal Name: <input type="text" name="GoalName" value="<?php if(isset($_POST['GoalName'])) echo $_POST['GoalName']; ?>"><br/>
			<input type="submit"/>
		</form>
			
	<?php		
		
		if(isset($_POST['ContactId'])){			
			var_dump(Infusionsoft_FunnelService::achieveGoal($_POST['IntegrationName'], $_POST['GoalName'], $_POST['ContactId']));
		}
    ?>
	</body>
</html>