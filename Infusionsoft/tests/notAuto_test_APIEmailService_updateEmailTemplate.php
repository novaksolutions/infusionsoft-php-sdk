
<form>
            templateId: <input type="text" name="templateId" value="<?php if(isset($_REQUEST['templateId'])) echo htmlspecialchars($_REQUEST['templateId']); ?>"><br/>
            pieceTitle: <input type="text" name="pieceTitle" value="<?php if(isset($_REQUEST['pieceTitle'])) echo htmlspecialchars($_REQUEST['pieceTitle']); ?>"><br/>
            categories: <input type="text" name="categories" value="<?php if(isset($_REQUEST['categories'])) echo htmlspecialchars($_REQUEST['categories']); ?>"><br/>
            fromAddress: <input type="text" name="fromAddress" value="<?php if(isset($_REQUEST['fromAddress'])) echo htmlspecialchars($_REQUEST['fromAddress']); ?>"><br/>
            toAddress: <input type="text" name="toAddress" value="<?php if(isset($_REQUEST['toAddress'])) echo htmlspecialchars($_REQUEST['toAddress']); ?>"><br/>
            ccAddress: <input type="text" name="ccAddress" value="<?php if(isset($_REQUEST['ccAddress'])) echo htmlspecialchars($_REQUEST['ccAddress']); ?>"><br/>
            bccAddress: <input type="text" name="bccAddress" value="<?php if(isset($_REQUEST['bccAddress'])) echo htmlspecialchars($_REQUEST['bccAddress']); ?>"><br/>
            subject: <input type="text" name="subject" value="<?php if(isset($_REQUEST['subject'])) echo htmlspecialchars($_REQUEST['subject']); ?>"><br/>
            textBody: <input type="text" name="textBody" value="<?php if(isset($_REQUEST['textBody'])) echo htmlspecialchars($_REQUEST['textBody']); ?>"><br/>
            htmlBody: <input type="text" name="htmlBody" value="<?php if(isset($_REQUEST['htmlBody'])) echo htmlspecialchars($_REQUEST['htmlBody']); ?>"><br/>
            contentType: <input type="text" name="contentType" value="<?php if(isset($_REQUEST['contentType'])) echo htmlspecialchars($_REQUEST['contentType']); ?>"><br/>
            mergeContext: <input type="text" name="mergeContext" value="<?php if(isset($_REQUEST['mergeContext'])) echo htmlspecialchars($_REQUEST['mergeContext']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::updateEmailTemplate($_REQUEST['templateId'], $_REQUEST['pieceTitle'], $_REQUEST['categories'], $_REQUEST['fromAddress'], $_REQUEST['toAddress'], $_REQUEST['ccAddress'], $_REQUEST['bccAddress'], $_REQUEST['subject'], $_REQUEST['textBody'], $_REQUEST['htmlBody'], $_REQUEST['contentType'], $_REQUEST['mergeContext']);
	var_dump($out);
}