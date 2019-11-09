<?php


namespace App\Constants;


final class MessageDeliveryStatus
{
    const UNKNOWN = 0;

    const READ = 1;

    const SENDING = 2;

    const RECEIVED = 3;

    const RECALLING =  4;

    const RECALLED = 5;
}