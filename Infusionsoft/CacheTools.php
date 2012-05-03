<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Joey
 * Date: 5/3/12
 * Time: 2:28 PM
 * To change this template use File | Settings | File Templates.
 */
class Infusionsoft_CacheTools{
    static function clearObjectCaches(Infusionsoft_Generated_Base $object = null){
        $path = dirname(__FILE__) . '/cache/';
        $glob_base = 'objects_';
        if ($object == null) {
            $glob_base .= $object->getTable() . '_';
        }
        $files = glob($path . $glob_base . '*');
        foreach ($files as $file) {
           if (is_file($file)) {
               unlink($file);
           }
       }
    }
}
