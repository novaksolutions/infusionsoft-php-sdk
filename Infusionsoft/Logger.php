<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jordan
 * Date: 2/28/13
 * Time: 12:32 PM
 * To change this template use File | Settings | File Templates.
 */

interface Infusionsoft_Logger {
    public function log(array $data);
    /*
     * $data array contains the following:
     *  'time' (Y-m-d H:i:s)
     *  'duration' (int - duration of request in seconds)
     *  'method' (string - API call sent)
     *  'args' (array)
     *  'attempts' (int)
     *  'result' (string - Failed or Successful)
     *  'error_message' (string - NULL unless result is Failed)
     */
}