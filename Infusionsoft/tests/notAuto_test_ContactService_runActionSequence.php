
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo htmlspecialchars($_REQUEST['contactId']); ?>"><br/>
            actionSequenceId: <input type="text" name="actionSequenceId" value="<?php if(isset($_REQUEST['actionSequenceId'])) echo htmlspecialchars($_REQUEST['actionSequenceId']); ?>"><br/>
            params: <input type="text" name="params" value="<?php if(isset($_REQUEST['params'])) echo htmlspecialchars($_REQUEST['params']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::runActionSequence($_REQUEST['contactId'], $_REQUEST['actionSequenceId'], $_REQUEST['params']);
	var_dump($out);
}