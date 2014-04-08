
<form>
            mergeContext: <input type="text" name="mergeContext" value="<?php if(isset($_REQUEST['mergeContext'])) echo htmlspecialchars($_REQUEST['mergeContext']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::getAvailableMergeFields($_REQUEST['mergeContext']);
	var_dump($out);
}