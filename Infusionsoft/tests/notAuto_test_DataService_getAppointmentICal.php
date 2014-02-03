
<form>
            appointmentId: <input type="text" name="appointmentId" value="<?php if(isset($_REQUEST['appointmentId'])) echo htmlspecialchars($_REQUEST['appointmentId']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::getAppointmentICal($_REQUEST['appointmentId']);
	var_dump($out);
}