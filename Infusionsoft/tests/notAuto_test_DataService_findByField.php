
<form>
            table: <input type="text" name="table" value="<?php if(isset($_REQUEST['table'])) echo htmlspecialchars($_REQUEST['table']); ?>"><br/>
            limit: <input type="text" name="limit" value="<?php if(isset($_REQUEST['limit'])) echo htmlspecialchars($_REQUEST['limit']); ?>"><br/>
            page: <input type="text" name="page" value="<?php if(isset($_REQUEST['page'])) echo htmlspecialchars($_REQUEST['page']); ?>"><br/>
            fieldName: <input type="text" name="fieldName" value="<?php if(isset($_REQUEST['fieldName'])) echo htmlspecialchars($_REQUEST['fieldName']); ?>"><br/>
            fieldValue: <input type="text" name="fieldValue" value="<?php if(isset($_REQUEST['fieldValue'])) echo htmlspecialchars($_REQUEST['fieldValue']); ?>"><br/>
            selectedFields: <input type="text" name="selectedFields" value="<?php if(isset($_REQUEST['selectedFields'])) echo htmlspecialchars($_REQUEST['selectedFields']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::findByField($_REQUEST['table'], $_REQUEST['limit'], $_REQUEST['page'], $_REQUEST['fieldName'], $_REQUEST['fieldValue'], $_REQUEST['selectedFields']);
	var_dump($out);
}