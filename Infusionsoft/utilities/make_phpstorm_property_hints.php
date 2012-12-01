<?php
    include('../infusionsoft.php');
    require_once('../examples/object_editor_all_tables.php');

    foreach($all_tables as $table){
        $class_name = 'Infusionsoft_' . $table;

        $object = new $class_name();
        $fields = $object->getFields();
        ?>
            <h1><?=$table?></h1>
            <pre>/**
<?php
        foreach($fields as $field){
            echo " * @property String $field\n";
        }
        ?> */</pre><?
    }


