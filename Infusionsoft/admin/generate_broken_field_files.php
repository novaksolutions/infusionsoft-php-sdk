<?php

$removed_fields = array(
    '0.9.14' => array(
    ),
    '0.9.13' => array(
    ),
    '0.9.12' => array(
        'Infusionsoft_CProgram' => array('SubCategory')
    ),
);

//We want a cascading effect.  If in version 0.9.6 we remove a field, we want to add it to all previous files, so we
//start with the latest version, and work our way backwards, always adding any removed fields from a later date to the earlier versions.
?><pre><?php
foreach($removed_fields as $version => $fields){
    if(!empty($previous_fields)) $fields = array_merge($fields, $previous_fields);
    $file = fopen('remove_field_files/' . $version . "_remove_fields.txt", "w");
    fwrite($file, serialize($fields));
    echo $version . " - " . print_r($fields, true) . "<br/>";
    $previous_fields = $fields;
}
?></pre><?php

