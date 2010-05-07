<?php
session_start();
?><html>
<body>
<?php
if(isset($_POST['appHostName'])){
	$_SESSION['appHostName'] = $_POST['appHostName'];
	$_SESSION['appPort'] = $_POST['appPort'];
	$_SESSION['appKey'] = $_POST['appHost'];
	echo 'App Session Info Set.';
}

if(isset($_POST['clearsession'])){
	unset($_SESSION['appHostName']);
	unset($_SESSION['appPort']);
	unset($_SESSION['appKey']);
	echo 'App Session Info Deleted.';
}
?>
<h1>Set App Info For Testing</h1>
<form method="post">
<table>
<tr>
<td>App Host Name: </td>
<td><input size="50" type="text" name="appHostName" value="<?php if(isset($_SESSION['appHostName'])) echo $_SESSION['appHostName']; ?>"></td>
</tr>

<tr>
<td>App Port: </td>
<td><input size="5" type="text" name="appPort" value="<?php if(isset($_SESSION['appPort'])) echo $_SESSION['appPort']; else echo '443'; ?>"></td>
</tr>

<tr>
<td>App Key:</td>
<td><input size="50" type="text" name="appHost" value="<?php if(isset($_SESSION['appKey'])) echo $_SESSION['appKey'];?>"></td>
</tr>
</table>

<input type="submit">
</form>
<br/>
Clear App Info From Session So Tests Use the config.php file.<br/>
<form method="post">
 <input type="hidden" name="clearsession" value="yes"/>
 <input type="submit" name="Clear Session" value="Clear Session"/>
</form>

<br/>
<h1>Tests</h1>
<ul>
	<li>
		<a href="tests/notAuto_testCChargeAccess.php">Test CCharge Table</a>
	</li>
</ul>

</body>
</html>
