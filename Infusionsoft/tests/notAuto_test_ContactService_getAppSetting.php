
<form>
        hash: <input type="text" name="hash" value="<?php if(isset($_REQUEST['hash'])) echo htmlspecialchars($_REQUEST['hash']); ?>"><br/>
            module: <input type="text" name="module" value="<?php if(isset($_REQUEST['module'])) echo htmlspecialchars($_REQUEST['module']); ?>"><br/>
            param: <input type="text" name="param" value="<?php if(isset($_REQUEST['param'])) echo htmlspecialchars($_REQUEST['param']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::getAppSetting($_REQUEST['hash'], $_REQUEST['module'], $_REQUEST['param']);
	var_dump($out);
}