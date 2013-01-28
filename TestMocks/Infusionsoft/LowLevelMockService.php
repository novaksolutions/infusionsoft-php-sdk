<?php
/**
 * Created by JetBrains PhpStorm.
 * User: joey
 * Date: 1/28/13
 * Time: 3:15 AM
 * To change this template use File | Settings | File Templates.
 */

class Infusionsoft_LowLevelMockService {
    var $data;
    public function __construct(Infusionsoft_AppData $data){
        $this->data = $data;
    }
}