<?php
	include('../infusionsoft.php');
	include('object_editor_all_tables.php');	
	include('../tests/testUtils.php');
	if(!empty($_GET['object'])){
        if($_SERVER['HTTP_HOST'] == 'sdk.novaksolutions.com'){
            echo "Sorry, we've disabled this on our server for security...";
            die();
        }
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
        ?><a href="<?=$file_name?>"><?=$file_name?></a><br/><br/><?

        if($_GET['object'] == 'Template'){
            echo 'Exporting email templates into files.' . "<br/>";
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
                    if($result->PieceType == 'Email' && substr($result->PieceTitle, 0, 14) != 'An email draft' && substr($result->PieceTitle, 0, 12) != 'API Template' && $result->Categories != 'Product Fulfillment'){
                        try{
                            $template = Infusionsoft_APIEmailService::getEmailTemplate($result->Id);

                            $file_name = "../exports/" . $_GET['object'] . '_' . $result->Id . '_' . date('Ymd-h.i.s') . '.txt';
                            echo 'Creating file: ' . $file_name . '<br/>';
                            $file = fopen($file_name, 'w');
                            fwrite($file, 'Title: ' . $template['pieceTitle'] . "\n");
                            fwrite($file, 'Categories: ' . $template['categories'] . "\n");
                            fwrite($file, 'From: ' . $template['fromAddress'] . "\n");
                            fwrite($file, 'To: ' . $template['toAddress'] . "\n");
                            fwrite($file, 'Cc: ' . $template['ccAddress'] . "\n");
                            fwrite($file, 'Bcc: ' . $template['bccAddress'] . "\n");
                            fwrite($file, 'Subject: ' . $template['subject'] . "\n\n");
                            fwrite($file, 'Text Body: ' . $template['textBody'] . "\n\n\n");
                            fwrite($file, 'Html Body: ' . $template['htmlBody'] . "\n");
                            fclose($file);
                        } catch(Exception $e){
                            echo "Could not export template: " . $result->Id . "<br/>";
                        }
                    }
                }
                $page++;
            }while(count($results) > 0);

        }
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
