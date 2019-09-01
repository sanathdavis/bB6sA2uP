<?php

namespace App\Meliorate\Constants;


class ServiceStatus
{
    const NEW_REQUEST = 'new';
    const READY_FOR_PICKUP = 'ready for pickup';
    const WAITING_ON_PARTS = 'waiting on parts';
    const CLOSED = 'closed';

    /**
     * get status options
     *
     * @return array
     */
    public static function getStatusOptions()
    {
        return [
            self::NEW_REQUEST => 'New',
            self::READY_FOR_PICKUP => 'Ready for Pickup',
            self::WAITING_ON_PARTS => 'Waiting on Parts',
            self::CLOSED => 'Closed',
        ];
    }

    public function __construct(){ 

    }
}