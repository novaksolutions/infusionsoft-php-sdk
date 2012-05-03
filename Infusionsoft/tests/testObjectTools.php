<?php
include('../infusionsoft.php');
include('testUtils.php');

$a = new Infusionsoft_Contact();
$a->FirstName = 'A';

$b = new Infusionsoft_Contact();
$b->FirstName = 'B';

$c = new Infusionsoft_Contact();
$c->FirstName = 'A';

$objects[] = $a;
$objects[] = $b;
$objects[] = $c;

$results = Infusionsoft_ObjectTools::findObjectsInList($objects, array('FirstName' => 'A'));

if(count($results) == 2){
    echo 'Success!!';
} else {
    echo 'False!!';
}
?>