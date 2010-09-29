
<form>
            table: <input type="text" name="table" value="<?php if(isset($_REQUEST['table'])) echo $_REQUEST['table']; ?>"><br/>
            id: <input type="text" name="id" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id']; ?>"><br/>
            selectedFields: <input type="text" name="selectedFields" value="<?php if(isset($_REQUEST['selectedFields'])) echo $_REQUEST['selectedFields']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::load($_REQUEST['table'], $_REQUEST['id'], $_REQUEST['selectedFields']);
	var_dump($out);
}