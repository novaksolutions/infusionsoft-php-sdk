<?php
namespace NovakSolutions\Infusionsoft;

class CacheTools{
    static function clearObjectCaches(Base $object = null){
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
