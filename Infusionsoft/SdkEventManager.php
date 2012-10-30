<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Joey
 * Date: 10/30/12
 * Time: 10:43 AM
 * To change this template use File | Settings | File Templates.
 */
class Infusionsoft_SdkEventManager {
    static $event_listeners = array();

    /**
     * @param callable $something
     * @param string $eventName
     */
    public static function attach($something, $eventName){
        self::$event_listeners[$eventName][] = $something;
    }

    /**
     * @param Infusionsoft_SdkEvent $event
     * @param string $eventName
     */
    public static function dispatch(Infusionsoft_SdkEvent $event, $eventName){
        if(isset(self::$event_listeners[$eventName])){
            foreach(self::$event_listeners[$eventName] as $listener){
                call_user_func($listener, $event, $eventName);
            }
        }
    }
}
