
<form>
            customFieldId: <input type="text" name="customFieldId" value="<?php if(isset($_REQUEST['customFieldId'])) echo htmlspecialchars($_REQUEST['customFieldId']); ?>"><br/>
            values: <input type="text" name="values" value="<?php if(isset($_REQUEST['values'])) echo htmlspecialchars($_REQUEST['values']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::updateCustomField($_REQUEST['customFieldId'], $_REQUEST['values']);
	var_dump($out);
}