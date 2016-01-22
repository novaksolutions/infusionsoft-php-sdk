<?php

/**
 * Time-based campaigns example
 * 
 * Easily achieve a campaign goal based on the time of day. For example, you 
 * can have a campaign sequence run only when this script is called during 
 * business hours.
 *
 * Additional documentation:
 * - https://novaksolutions.com/tips/start-an-infusionsoft-campaign-sequence-based-on-the-time-of-day/
 * - https://developer.infusionsoft.com/docs/read/Funnel_Service
 */

// Set default script options. These parameters are used in your campaign goal.
// You can override these in your HTTP post.
$options['integration'] = 'someIntegration';
$options['callName']    = 'myAPIcall';
$options['startTime']   = '0800'; // HHMM in 24 hour format with leading zeroes. This is based on your server time.
$options['stopTime']    = '1600'; // HHMM in 24 hour format with leading zeroes. This is based on your server time.

/********************************************************/
/* You shouldn't need to edit anything below this line! */
/********************************************************/

// Include the SDK loader
include('../infusionsoft.php');

// Check for required contactId
if (!isset($_POST['contactId']) || !is_numeric($_POST['contactId'])) {
    die('Required parameter "contactId" is missing or invalid.');
}

// Override default integration name if supplied
if (isset($_POST['integration'])) {
    $options['integration'] = $_POST['integration'];
}

// Override default call name if supplied
if (isset($_POST['callName'])) {
    $options['callName'] = $_POST['callName'];
}

// Check for start time
if (isset($_POST['startTime'])) {
    $options['startTime'] = $_POST['startTime'];
}

// Check for stop time
// It is assumed that the stop time is for the next day if stopTime < startTime
if (isset($_POST['stopTime'])) {
    $options['stopTime'] = $_POST['stopTime'];
}

// Call the achieveGoal method if current time is between start/stop time
if ($options['startTime'] > $options['stopTime']) {
    if (date("Hi") >= $options['startTime'] || date("Hi") <= $options['stopTime']) {
        Infusionsoft_FunnelService::achieveGoal($options['integration'], $options['callName'], $_POST['contactId']);
    }
} else {
    if (date("Hi") >= $options['startTime'] && date("Hi") <= $options['stopTime']) {
        Infusionsoft_FunnelService::achieveGoal($options['integration'], $options['callName'], $_POST['contactId']);
    }
}