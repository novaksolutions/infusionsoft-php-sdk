
<form>
            locateMapId: <input type="text" name="locateMapId" value="<?php if(isset($_REQUEST['locateMapId'])) echo htmlspecialchars($_REQUEST['locateMapId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::markLinkUpdated($_REQUEST['locateMapId']);
	var_dump($out);
}