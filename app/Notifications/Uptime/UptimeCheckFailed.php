<?php

namespace App\Notifications\Uptime;

use App\Traits\NotificationCheckStatus;

class UptimeCheckFailed extends \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckFailed
{
    use NotificationCheckStatus;

    public function getMessageText(): string
    {
        return "*{$this->getDetailDomain()} is DOWN*";
    }
}
