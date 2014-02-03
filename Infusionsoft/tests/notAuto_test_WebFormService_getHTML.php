
<form>
            webformId: <input type="text" name="webformId" value="<?php if(isset($_REQUEST['webformId'])) echo htmlspecialchars($_REQUEST['webformId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_WebFormService::getHTML($_REQUEST['webformId']);
	var_dump($out);
}