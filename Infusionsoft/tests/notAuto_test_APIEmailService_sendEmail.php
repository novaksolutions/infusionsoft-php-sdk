
<form>
            contactList: <input type="text" name="contactList" value="<?php if(isset($_REQUEST['contactList'])) echo htmlspecialchars($_REQUEST['contactList']); ?>"><br/>
            fromAddress: <input type="text" name="fromAddress" value="<?php if(isset($_REQUEST['fromAddress'])) echo htmlspecialchars($_REQUEST['fromAddress']); ?>"><br/>
            toAddress: <input type="text" name="toAddress" value="<?php if(isset($_REQUEST['toAddress'])) echo htmlspecialchars($_REQUEST['toAddress']); ?>"><br/>
            ccAddresses: <input type="text" name="ccAddresses" value="<?php if(isset($_REQUEST['ccAddresses'])) echo htmlspecialchars($_REQUEST['ccAddresses']); ?>"><br/>
            bccAddresses: <input type="text" name="bccAddresses" value="<?php if(isset($_REQUEST['bccAddresses'])) echo htmlspecialchars($_REQUEST['bccAddresses']); ?>"><br/>
            contentType: <input type="text" name="contentType" value="<?php if(isset($_REQUEST['contentType'])) echo htmlspecialchars($_REQUEST['contentType']); ?>"><br/>
            subject: <input type="text" name="subject" value="<?php if(isset($_REQUEST['subject'])) echo htmlspecialchars($_REQUEST['subject']); ?>"><br/>
            htmlBody: <input type="text" name="htmlBody" value="<?php if(isset($_REQUEST['htmlBody'])) echo htmlspecialchars($_REQUEST['htmlBody']); ?>"><br/>
            textBody: <input type="text" name="textBody" value="<?php if(isset($_REQUEST['textBody'])) echo htmlspecialchars($_REQUEST['textBody']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::sendEmail($_REQUEST['contactList'], $_REQUEST['fromAddress'], $_REQUEST['toAddress'], $_REQUEST['ccAddresses'], $_REQUEST['bccAddresses'], $_REQUEST['contentType'], $_REQUEST['subject'], $_REQUEST['htmlBody'], $_REQUEST['textBody']);
	var_dump($out);
}