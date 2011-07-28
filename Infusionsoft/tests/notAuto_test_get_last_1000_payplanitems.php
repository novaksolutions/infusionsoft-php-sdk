
<form>
    <input type="submit">
    <input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::queryWithOrderBy(new Infusionsoft_PayPlanItem(), array('Id'=>'%'), 'Id', false);
	var_dump($out);
}