<?php
namespace NovakSolutions\Infusionsoft;

class SdkEventManager {
    static $event_listeners = array();

    /**
     * @param callable $something
     * @param string $eventName
     */
    public static function attach($something, $eventName){
        self::$event_listeners[$eventName][] = $something;
    }

    /**
     * @param SdkEvent $event
     * @param string $eventName
     */
    public static function dispatch(SdkEvent $event, $eventName){
        if(isset(self::$event_listeners[$eventName])){
            foreach(self::$event_listeners[$eventName] as $listener){
                call_user_func($listener, $event, $eventName);
            }
        }
    }
}
