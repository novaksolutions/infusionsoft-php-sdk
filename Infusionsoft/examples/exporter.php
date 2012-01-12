<?php
	include('../infusionsoft.php');
	include('object_editor_all_tables.php');	
	include('../tests/testUtils.php');
	if(!empty($_GET['object'])){
		$class_name = "Infusionsoft_" . $_GET['object'];
		$object = null;

        $reflection = new ReflectionObject(new $class_name());

        if($reflection->hasProperty('customFieldFormId')){
            echo 'Adding all custom fields available to object' . '<br/>';
            $custom_fields = Infusionsoft_DataService::getCustomFields(new $class_name());
            $class_name::addCustomFields(array_keys($custom_fields));
        }

        $object = new $class_name();

        if(!file_exists("../exports")){
            mkdir("../exports/");
        }


        $file_name = "../exports/" . $_GET['object'] . '_export_' . date('Ymd-h.i.s') . '.csv';
        echo 'Creating csv file: ' . $file_name . '<br/>';
        $csv_file = fopen($file_name, 'w');

        fputcsv($csv_file, $object->getFields(), ",", "\"");
        $page = 0;
        do{
            echo 'Fetching page ' . $page . '<br/>';
            flush();
            $object_fields = $object->getFields();

            if(in_array('Id', $object_fields)){
                $results = Infusionsoft_DataService::queryWithOrderBy(new $class_name(), array('Id' => '%'), 'Id', true, 100, $page );
            }else {
                $results = Infusionsoft_DataService::queryWithOrderBy(new $class_name(), array($object_fields[0] => '%'), $object_fields[0], true, 100, $page );
            }

            foreach($results as $result){
                fputcsv($csv_file, $result->toArray(), ",", "\"");
            }
            $page++;
        }while(count($results) > 0);

        echo 'Closing csv file. <br/>';
        fclose($csv_file);
        ?><a href="<?=$file_name?>"><?=$file_name?></a><?
	}
	
?>
<form>
    Table To Export:
    <select name="object">
        <?php
            global $all_tables;
            sort($all_tables);
            foreach($all_tables as $table){
                ?><option value="<?php echo $table; ?>"><?php echo $table; ?></option><?php
            }
        ?>
    </select><br/>

    <input type="submit"/>
</form>
<?php
