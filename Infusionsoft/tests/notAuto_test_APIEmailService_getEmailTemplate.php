
<form>
            templateId: <input type="text" name="templateId" value="<?php if(isset($_REQUEST['templateId'])) echo htmlspecialchars($_REQUEST['templateId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::getEmailTemplate($_REQUEST['templateId']);
	var_dump($out);
}