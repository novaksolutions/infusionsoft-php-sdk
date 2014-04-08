
<form>
            affiliateIds: <input type="text" name="affiliateIds" value="<?php if(isset($_REQUEST['affiliateIds'])) echo htmlspecialchars($_REQUEST['affiliateIds']); ?>"><br/>
            filterStartDate: <input type="text" name="filterStartDate" value="<?php if(isset($_REQUEST['filterStartDate'])) echo htmlspecialchars($_REQUEST['filterStartDate']); ?>"><br/>
            filterEndDate: <input type="text" name="filterEndDate" value="<?php if(isset($_REQUEST['filterEndDate'])) echo htmlspecialchars($_REQUEST['filterEndDate']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIAffiliateService::affSummary($_REQUEST['affiliateIds'], $_REQUEST['filterStartDate'], $_REQUEST['filterEndDate']);
	var_dump($out);
}