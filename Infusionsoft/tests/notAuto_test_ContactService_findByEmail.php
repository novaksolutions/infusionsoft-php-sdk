
<form>
            email: <input type="text" name="email" value="<?php if(isset($_REQUEST['email'])) echo htmlspecialchars($_REQUEST['email']); ?>"><br/>
            selectedFields: <input type="text" name="selectedFields" value="<?php if(isset($_REQUEST['selectedFields'])) echo htmlspecialchars($_REQUEST['selectedFields']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::findByEmail($_REQUEST['email'], $_REQUEST['selectedFields']);
	var_dump($out);
}