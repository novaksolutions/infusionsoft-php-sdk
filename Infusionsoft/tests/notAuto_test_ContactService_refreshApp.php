
<form>
        hash: <input type="text" name="hash" value="<?php if(isset($_REQUEST['hash'])) echo htmlspecialchars($_REQUEST['hash']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::refreshApp($_REQUEST['hash']);
	var_dump($out);
}