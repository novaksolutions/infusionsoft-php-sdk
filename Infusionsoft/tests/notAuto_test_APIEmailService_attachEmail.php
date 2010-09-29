
<form>
            contactId: <input type="text" name="contactId" value="<?php if(isset($_REQUEST['contactId'])) echo $_REQUEST['contactId']; ?>"><br/>
            fromName: <input type="text" name="fromName" value="<?php if(isset($_REQUEST['fromName'])) echo $_REQUEST['fromName']; ?>"><br/>
            fromAddress: <input type="text" name="fromAddress" value="<?php if(isset($_REQUEST['fromAddress'])) echo $_REQUEST['fromAddress']; ?>"><br/>
            toAddress: <input type="text" name="toAddress" value="<?php if(isset($_REQUEST['toAddress'])) echo $_REQUEST['toAddress']; ?>"><br/>
            ccAddresses: <input type="text" name="ccAddresses" value="<?php if(isset($_REQUEST['ccAddresses'])) echo $_REQUEST['ccAddresses']; ?>"><br/>
            bccAddresses: <input type="text" name="bccAddresses" value="<?php if(isset($_REQUEST['bccAddresses'])) echo $_REQUEST['bccAddresses']; ?>"><br/>
            contentType: <input type="text" name="contentType" value="<?php if(isset($_REQUEST['contentType'])) echo $_REQUEST['contentType']; ?>"><br/>
            subject: <input type="text" name="subject" value="<?php if(isset($_REQUEST['subject'])) echo $_REQUEST['subject']; ?>"><br/>
            htmlBody: <input type="text" name="htmlBody" value="<?php if(isset($_REQUEST['htmlBody'])) echo $_REQUEST['htmlBody']; ?>"><br/>
            textBody: <input type="text" name="textBody" value="<?php if(isset($_REQUEST['textBody'])) echo $_REQUEST['textBody']; ?>"><br/>
            header: <input type="text" name="header" value="<?php if(isset($_REQUEST['header'])) echo $_REQUEST['header']; ?>"><br/>
            receivedDate: <input type="text" name="receivedDate" value="<?php if(isset($_REQUEST['receivedDate'])) echo $_REQUEST['receivedDate']; ?>"><br/>
            sentDate: <input type="text" name="sentDate" value="<?php if(isset($_REQUEST['sentDate'])) echo $_REQUEST['sentDate']; ?>"><br/>
            emailSentType: <input type="text" name="emailSentType" value="<?php if(isset($_REQUEST['emailSentType'])) echo $_REQUEST['emailSentType']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_APIEmailService::attachEmail($_REQUEST['contactId'], $_REQUEST['fromName'], $_REQUEST['fromAddress'], $_REQUEST['toAddress'], $_REQUEST['ccAddresses'], $_REQUEST['bccAddresses'], $_REQUEST['contentType'], $_REQUEST['subject'], $_REQUEST['htmlBody'], $_REQUEST['textBody'], $_REQUEST['header'], $_REQUEST['receivedDate'], $_REQUEST['sentDate'], $_REQUEST['emailSentType']);
	var_dump($out);
}