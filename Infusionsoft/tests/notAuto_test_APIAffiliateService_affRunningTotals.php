
<form>
            affiliateIds: <input type="text" name="affiliateIds" value="<?php if(isset($_REQUEST['affiliateIds'])) echo htmlspecialchars($_REQUEST['affiliateIds']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIAffiliateService::affRunningTotals($_REQUEST['affiliateIds']);
	var_dump($out);
}