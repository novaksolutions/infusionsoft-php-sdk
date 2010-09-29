
<form>
            affiliateId: <input type="text" name="affiliateId" value="<?php if(isset($_REQUEST['affiliateId'])) echo $_REQUEST['affiliateId']; ?>"><br/>
            filterStartDate: <input type="text" name="filterStartDate" value="<?php if(isset($_REQUEST['filterStartDate'])) echo $_REQUEST['filterStartDate']; ?>"><br/>
            filterEndDate: <input type="text" name="filterEndDate" value="<?php if(isset($_REQUEST['filterEndDate'])) echo $_REQUEST['filterEndDate']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIAffiliateService::affCommissions($_REQUEST['affiliateId'], $_REQUEST['filterStartDate'], $_REQUEST['filterEndDate']);
	var_dump($out);
}