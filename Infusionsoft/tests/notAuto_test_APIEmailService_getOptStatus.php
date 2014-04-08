
<form>
            email: <input type="text" name="email" value="<?php if(isset($_REQUEST['email'])) echo htmlspecialchars($_REQUEST['email']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::getOptStatus($_REQUEST['email']);
	var_dump($out);
}