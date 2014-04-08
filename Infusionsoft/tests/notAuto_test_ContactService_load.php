
<form>
            id: <input type="text" name="id" value="<?php if(isset($_REQUEST['id'])) echo htmlspecialchars($_REQUEST['id']); ?>"><br/>
            selectedFields: <input type="text" name="selectedFields" value="<?php if(isset($_REQUEST['selectedFields'])) echo htmlspecialchars($_REQUEST['selectedFields']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::load($_REQUEST['id'], $_REQUEST['selectedFields']);
	var_dump($out);
}