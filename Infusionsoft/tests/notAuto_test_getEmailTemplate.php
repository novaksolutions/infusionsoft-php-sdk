<form>
Template Id: <input type="text" name="TemplateId">
<input type="submit">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['TemplateId'])){
	$template = Infusionsoft_EmailService::getEmailTemplate($_REQUEST['TemplateId'] + 0);
	?>
	<H1>Template Source (htmlBody)</H1>
	<?php
	echo "<pre>" . $template['htmlBody'] . "</pre>";
}