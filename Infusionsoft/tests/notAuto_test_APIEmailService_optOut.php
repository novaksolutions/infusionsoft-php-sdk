
<form>
            email: <input type="text" name="email" value="<?php if(isset($_REQUEST['email'])) echo htmlspecialchars($_REQUEST['email']); ?>"><br/>
            reason: <input type="text" name="reason" value="<?php if(isset($_REQUEST['reason'])) echo htmlspecialchars($_REQUEST['reason']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::optOut($_REQUEST['email'], $_REQUEST['reason']);
	var_dump($out);
}