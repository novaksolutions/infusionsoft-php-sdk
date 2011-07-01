<form>
    userId: <input type="text" name="userId" value="<?php if(isset($_REQUEST['userId'])) echo htmlentities($_REQUEST['userId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_SearchService::getDefaultQuickSearch($_REQUEST['userId']);
	var_dump($out);
}