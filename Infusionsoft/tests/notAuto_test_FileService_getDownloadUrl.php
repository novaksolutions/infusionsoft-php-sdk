
<form>
            fileId: <input type="text" name="fileId" value="<?php if(isset($_REQUEST['fileId'])) echo htmlspecialchars($_REQUEST['fileId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_FileService::getDownloadUrl($_REQUEST['fileId']);
	var_dump($out);
}