<form>
    savedSearchId: <input type="text" name="savedSearchId" value="<?php if(isset($_REQUEST['savedSearchId'])) echo htmlspecialchars($_REQUEST['savedSearchId']); ?>"><br/>
    userId: <input type="text" name="userId" value="<?php if(isset($_REQUEST['userId'])) echo htmlspecialchars($_REQUEST['userId']); ?>"><br/>
    pageNumber: <input type="text" name="pageNumber" value="<?php if(isset($_REQUEST['pageNumber'])) echo htmlspecialchars($_REQUEST['pageNumber']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_SearchService::getSavedSearchResultsAllFields($_REQUEST['savedSearchId'], $_REQUEST['userId'], $_REQUEST['pageNumber']);
	var_dump($out);
}