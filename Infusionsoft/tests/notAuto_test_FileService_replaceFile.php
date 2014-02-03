
<form>
            fileId: <input type="text" name="fileId" value="<?php if(isset($_REQUEST['fileId'])) echo htmlspecialchars($_REQUEST['fileId']); ?>"><br/>
            base64encoded: <input type="text" name="base64encoded" value="<?php if(isset($_REQUEST['base64encoded'])) echo htmlspecialchars($_REQUEST['base64encoded']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_FileService::replaceFile($_REQUEST['fileId'], $_REQUEST['base64encoded']);
	var_dump($out);
}