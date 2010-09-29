
<form>
            table: <input type="text" name="table" value="<?php if(isset($_REQUEST['table'])) echo $_REQUEST['table']; ?>"><br/>
            values: <input type="text" name="values" value="<?php if(isset($_REQUEST['values'])) echo $_REQUEST['values']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::add($_REQUEST['table'], $_REQUEST['values']);
	var_dump($out);
}