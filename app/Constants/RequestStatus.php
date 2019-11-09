<?php


namespace App\Constants;


final class RequestStatus {
    const PENDING = 0;
    const ACCEPTED = 1;
    const ACCEPTED_WITHOUT_CONFIRM = 2;
    const DECLINED = 3;
    const IGNORED = 4;
    const EXPIRED = 5;
    const CANCELED = 6;
}