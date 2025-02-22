<?php

namespace App\Notifications\Uptime;

use App\Traits\NotificationCheckStatus;

class UptimeCheckSucceeded extends \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckSucceeded
{
    use NotificationCheckStatus;

    public function getMessageText(): string
    {
        return "{$this->getDetailDomain()} is up";
    }
}
