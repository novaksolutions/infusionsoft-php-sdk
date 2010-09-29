
<form>
            context: <input type="text" name="context" value="<?php if(isset($_REQUEST['context'])) echo $_REQUEST['context']; ?>"><br/>
            displayName: <input type="text" name="displayName" value="<?php if(isset($_REQUEST['displayName'])) echo $_REQUEST['displayName']; ?>"><br/>
            dataType: <input type="text" name="dataType" value="<?php if(isset($_REQUEST['dataType'])) echo $_REQUEST['dataType']; ?>"><br/>
            groupId: <input type="text" name="groupId" value="<?php if(isset($_REQUEST['groupId'])) echo $_REQUEST['groupId']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::addCustomField($_REQUEST['context'], $_REQUEST['displayName'], $_REQUEST['dataType'], $_REQUEST['groupId']);
	var_dump($out);
}