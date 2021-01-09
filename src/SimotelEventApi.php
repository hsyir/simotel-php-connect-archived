<?php

namespace Hsy\Simotel;

class SimotelEventApi
{
    use SimotelEvents;

    public function addListener($event, callable $callback)
    {
        self::addEventListener($event, $callback);
    }

    public function dispatch($event, $data)
    {
        self::dispatchEvent($event, $data);
    }
}
