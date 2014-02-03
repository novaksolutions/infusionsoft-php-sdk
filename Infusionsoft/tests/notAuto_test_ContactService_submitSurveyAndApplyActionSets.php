
<form>
            surveyResultId: <input type="text" name="surveyResultId" value="<?php if(isset($_REQUEST['surveyResultId'])) echo htmlspecialchars($_REQUEST['surveyResultId']); ?>"><br/>
            actionSetIds: <input type="text" name="actionSetIds" value="<?php if(isset($_REQUEST['actionSetIds'])) echo htmlspecialchars($_REQUEST['actionSetIds']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_ContactService::submitSurveyAndApplyActionSets($_REQUEST['surveyResultId'], $_REQUEST['actionSetIds']);
	var_dump($out);
}