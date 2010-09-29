
<form>
            data: <input type="text" name="data" value="<?php if(isset($_REQUEST['data'])) echo $_REQUEST['data']; ?>"><br/>
            dupCheckType: <input type="text" name="dupCheckType" value="<?php if(isset($_REQUEST['dupCheckType'])) echo $_REQUEST['dupCheckType']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::addWithDupCheck($_REQUEST['data'], $_REQUEST['dupCheckType']);
	var_dump($out);
}