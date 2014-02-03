
<form>
            table: <input type="text" name="table" value="<?php if(isset($_REQUEST['table'])) echo htmlspecialchars($_REQUEST['table']); ?>"><br/>
            limit: <input type="text" name="limit" value="<?php if(isset($_REQUEST['limit'])) echo htmlspecialchars($_REQUEST['limit']); ?>"><br/>
            page: <input type="text" name="page" value="<?php if(isset($_REQUEST['page'])) echo htmlspecialchars($_REQUEST['page']); ?>"><br/>
            searchFieldName:<input type="text" name="searchFieldName" value="<?php if(isset($_REQUEST['searchFieldName'])) echo htmlspecialchars($_REQUEST['searchFieldName']); ?>"><br/>
            searchFieldData:<input type="text" name="searchFieldData" value="<?php if(isset($_REQUEST['searchFieldData'])) echo htmlspecialchars($_REQUEST['searchFieldData']); ?>"><br/>
            queryFieldName: <input type="text" name="queryFieldName" value="<?php if(isset($_REQUEST['queryFieldName'])) echo htmlspecialchars($_REQUEST['queryFieldName']); ?>"><br/>
            queryFieldData: <input type="text" name="queryFieldData" value="<?php if(isset($_REQUEST['queryFieldData'])) echo htmlspecialchars($_REQUEST['queryFieldData']); ?>"><br/>
            selectedFields: <input type="text" name="selectedFields" value="<?php if(isset($_REQUEST['selectedFields'])) echo htmlspecialchars($_REQUEST['selectedFields']); ?>"><br/>
            orderBy: <input type="text" name="orderBy" value="<?php if(isset($_REQUEST['orderBy'])) echo htmlspecialchars($_REQUEST['orderBy']); ?>"><br/>
            ascending: <input type="text" name="ascending" value="<?php if(isset($_REQUEST['ascending'])) echo htmlspecialchars($_REQUEST['ascending']); ?>"><br/>
    <input type="submit">
<input type="hidden" name="go">
</form>
<?php
include('../infusionsoft.php');
include('testUtils.php');
if(isset($_REQUEST['go'])){
    $object = "Infusionsoft_" . $_REQUEST['table'];
    $object = new $object;
    $searchData = array($_REQUEST['searchFieldName'] => $_REQUEST['searchFieldData']);
    if ($_REQUEST['queryFieldData'] !== ''){
        $queryData = array($_REQUEST['queryFieldName'] => $_REQUEST['queryFieldData']);
    }
    else $queryData = array();
    if ($_REQUEST['ascending'] == "false"){
        $ascending = false;
    } elseif ($_REQUEST['ascending'] == "true"){
        $ascending = true;
    } else $ascending = true;
    if ($_REQUEST['limit'] == ''){
        $limit = 1000;
    } else $limit = $_REQUEST['limit'];
    if ($_REQUEST['page'] == ''){
        $page = 0;
    } else $page = $_REQUEST['page'];
    if ($_REQUEST['selectedFields'] == ''){
        $returnFields = false;
    } else $returnFields = $_REQUEST['selectedFields'];

	$out = Infusionsoft_DataService::searchWithOrderBy($object, $_REQUEST['orderBy'], $searchData, $queryData, $ascending, $limit, $page, $returnFields);
	var_dump($out);
}