<?php

include('../infusionsoft.php');
include('testUtils.php');


$app = Infusionsoft_AppPool::getApp();
$app->enableDebug();
$contact = new Infusionsoft_Contact(1);
