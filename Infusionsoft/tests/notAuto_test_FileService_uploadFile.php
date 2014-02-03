
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            fileName: <input type="text" name="fileName" value="<?php if(isset($_REQUEST['fileName'])) echo htmlspecialchars($_REQUEST['fileName']); ?>"><br/>
            base64encoded: <input type="text" name="base64encoded" value="<?php if(isset($_REQUEST['base64encoded'])) echo htmlspecialchars($_REQUEST['base64encoded']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_FileService::uploadFile($_REQUEST['contactId'], $_REQUEST['fileName'], $_REQUEST['base64encoded']);
	var_dump($out);
}