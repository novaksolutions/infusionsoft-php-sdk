
<form>
        vendorKey: <input type="text" name="vendorKey" value="<?php if(isset($_REQUEST['vendorKey'])) echo $_REQUEST['vendorKey']; ?>"><br/>
            username: <input type="text" name="username" value="<?php if(isset($_REQUEST['username'])) echo $_REQUEST['username']; ?>"><br/>
            passwordHash: <input type="text" name="passwordHash" value="<?php if(isset($_REQUEST['passwordHash'])) echo $_REQUEST['passwordHash']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::getTemporaryKey($_REQUEST['vendorKey'], $_REQUEST['username'], $_REQUEST['passwordHash']);
	var_dump($out);
}