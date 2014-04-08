
<form>
            table: <input type="text" name="table" value="<?php if(isset($_REQUEST['table'])) echo htmlspecialchars($_REQUEST['table']); ?>"><br/>
            id: <input type="text" name="id" value="<?php if(isset($_REQUEST['id'])) echo htmlspecialchars($_REQUEST['id']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::delete($_REQUEST['table'], $_REQUEST['id']);
	var_dump($out);
}