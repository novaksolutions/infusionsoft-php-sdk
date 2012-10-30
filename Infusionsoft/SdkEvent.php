<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Joey
 * Date: 10/30/12
 * Time: 10:43 AM
 * To change this template use File | Settings | File Templates.
 */
class Infusionsoft_SdkEvent {
    public $subject = null;
    public $params = array();

    public function __construct($subject, array $params = array()){
        $this->subject = $subject;
        $this->params = $params;
    }
}
