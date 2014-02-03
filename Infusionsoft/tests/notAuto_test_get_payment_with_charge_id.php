
<form>
            CChargeId: <input type="text" name="cChargeId" value="<?php if(isset($_REQUEST['cChargeId'])) echo htmlspecialchars($_REQUEST['cChargeId']); ?>"><br/>
    <input type="submit">
    <input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::query(new Infusionsoft_Payment(), array('ChargeId' => $_REQUEST['cChargeId']), 'Id');
	var_dump($out);
}