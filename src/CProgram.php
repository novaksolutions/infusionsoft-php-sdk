<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 4/28/2015
 * Time: 10:44 PM
 */

namespace NovakSolutions\Infusionsoft;


class CProgram extends Base{
    public function __construct($id = 0, $app = null){
        throw new \Exception("The CProgram class has been deprecated and shouldn't be used any longer, use SubscriptionPlan instead.");
    }
} 