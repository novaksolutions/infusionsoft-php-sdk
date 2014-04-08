
<form>
            fullyQualifiedClassName: <input type="text" name="fullyQualifiedClassName" value="<?php if(isset($_REQUEST['fullyQualifiedClassName'])) echo htmlspecialchars($_REQUEST['fullyQualifiedClassName']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_InvoiceService::getPluginStatus($_REQUEST['fullyQualifiedClassName']);
	var_dump($out);
}