<?php
ini_set("")
error_reporting(E_ALL);

// Include the SDK
require_once('Infusionsoft/infusionsoft.php');

// Create a new contact object
$payment = new Infusionsoft_InvoicePayment(78649);

var_dump($payment->toArray());