
<form>
            table: <input type="text" name="table" value="<?php if(isset($_REQUEST['table'])) echo $_REQUEST['table']; ?>"><br/>
            limit: <input type="text" name="limit" value="<?php if(isset($_REQUEST['limit'])) echo $_REQUEST['limit']; ?>"><br/>
            page: <input type="text" name="page" value="<?php if(isset($_REQUEST['page'])) echo $_REQUEST['page']; ?>"><br/>
            queryData: <input type="text" name="queryData" value="<?php if(isset($_REQUEST['queryData'])) echo $_REQUEST['queryData']; ?>"><br/>
            selectedFields: <input type="text" name="selectedFields" value="<?php if(isset($_REQUEST['selectedFields'])) echo $_REQUEST['selectedFields']; ?>"><br/>
            orderBy: <input type="text" name="orderBy" value="<?php if(isset($_REQUEST['orderBy'])) echo $_REQUEST['orderBy']; ?>"><br/>
            ascending: <input type="text" name="ascending" value="<?php if(isset($_REQUEST['ascending'])) echo $_REQUEST['ascending']; ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');

if(isset($_REQUEST['go'])){
	$out = Infusionsoft_DataService::query($_REQUEST['table'], $_REQUEST['limit'], $_REQUEST['page'], $_REQUEST['queryData'], $_REQUEST['selectedFields'], $_REQUEST['orderBy'], $_REQUEST['ascending']);
	var_dump($out);
}