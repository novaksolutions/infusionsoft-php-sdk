<?php
if(isset($_POST['fileNamePattern'])){
    if($_SERVER['HTTP_HOST'] == 'sdk.novaksolutions.com'){
        echo "Sorry, we've disabled this on our server for security...";
        die();
    }
    echo "Generating Code...<br/>";
    require_once('../examples/object_editor_all_tables.php');
    foreach($all_tables as $table){
        $file_name = str_replace('~TableName~', $table, $_POST['fileNamePattern']);
        file_put_contents($file_name, str_replace("~TableName~", $table, $_POST['fileTemplate']));
        echo "Creating File: $file_name <br/>";
    }
    echo "Done Merging Files..<br/>";
}

/**
 * Created by JetBrains PhpStorm.
 * User: Joey
 * Date: 8/24/12
 * Time: 2:02 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<h1>Code Generator</h1>
<p>This tool will generate a file based on the information you put in below for each Data Object.</p>
<style>
    label{
        display:block;
    }
</style>
<form action="" method="post">
    <label>FileNamePattern</label>
    <input type="text" name="fileNamePattern" value="out/Infusionsoft~TableName~.php"/>
    <label>FileTemplate</label>
    <textarea rows="40" cols="80" name="fileTemplate">&lt;?php
    App::uses('NoTableCheckModel', 'Model');
    class Infusionsoft~TableName~ extends NoTableCheckModel{

    }</textarea>
    <br/>
    <input type="submit"/>
</form>