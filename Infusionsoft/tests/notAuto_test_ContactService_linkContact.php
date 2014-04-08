
<form>
            remoteApp: <input type="text" name="remoteApp" value="<?php if(isset($_REQUEST['remoteApp'])) echo htmlspecialchars($_REQUEST['remoteApp']); ?>"><br/>
            remoteId: <input type="text" name="remoteId" value="<?php if(isset($_REQUEST['remoteId'])) echo htmlspecialchars($_REQUEST['remoteId']); ?>"><br/>
            localId: <input type="text" name="localId" value="<?php if(isset($_REQUEST['localId'])) echo htmlspecialchars($_REQUEST['localId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::linkContact($_REQUEST['remoteApp'], $_REQUEST['remoteId'], $_REQUEST['localId']);
	var_dump($out);
}