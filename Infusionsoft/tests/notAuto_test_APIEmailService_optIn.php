
<form>
            email: <input type="text" name="email" value="<?php if(isset($_REQUEST['email'])) echo htmlspecialchars($_REQUEST['email']); ?>"><br/>
            permissionReason: <input type="text" name="permissionReason" value="<?php if(isset($_REQUEST['permissionReason'])) echo htmlspecialchars($_REQUEST['permissionReason']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::optIn($_REQUEST['email'], $_REQUEST['permissionReason']);
	var_dump($out);
}