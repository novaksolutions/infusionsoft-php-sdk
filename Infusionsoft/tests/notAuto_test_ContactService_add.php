
<form>
            data: <input type="text" name="data" value="<?php if(isset($_REQUEST['data'])) echo htmlspecialchars($_REQUEST['data']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::add($_REQUEST['data']);
	var_dump($out);
}