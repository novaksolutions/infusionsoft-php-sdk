
<form>
            fileId: <input type="text" name="fileId" value="<?php if(isset($_REQUEST['fileId'])) echo htmlspecialchars($_REQUEST['fileId']); ?>"><br/>
            fileName: <input type="text" name="fileName" value="<?php if(isset($_REQUEST['fileName'])) echo htmlspecialchars($_REQUEST['fileName']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_FileService::renameFile($_REQUEST['fileId'], $_REQUEST['fileName']);
	var_dump($out);
}