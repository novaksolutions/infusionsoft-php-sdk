<?php
/**
 * @var Infusionsoft_Generated_Base $object
 */
include('../infusionsoft.php');
	include('object_editor_all_tables.php');
	include('../tests/testUtils.php');
	?>
<form>
    Table:<br/>
    <select name="object">
        <?php
            global $all_tables;
            sort($all_tables);
            foreach($all_tables as $table){
                ?><option value="<?php echo htmlspecialchars($table); ?>"><?php echo htmlspecialchars($table); ?></option><?php
            }
        ?>
    </select><br/>
    <input type="submit"/>
</form>
<?php

if(isset($_GET['object'])){
    $class_name = "Infusionsoft_" . $_GET['object'];
    $object = new $class_name();

    $objects = Infusionsoft_DataService::query(new $class_name(), array('Id' => '%'));
    ?>
        <table>
            <thead>
                <tr>
                    <?php
                        foreach($object->getFields() as $field){
                            ?><th><?=htmlspecialchars($field)?></th><?php
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($objects as $object){
                    ?><tr><?php
                    foreach($object->toArray() as $data){
                        ?><td><?=htmlspecialchars($data)?></td><?php
                    }
                    ?></tr><?php
                }
                ?>
          </tbody>
        </table>
    <?php
}