<?php

namespace App\Notifications\Uptime;

use Illuminate\Bus\Queueable;
use App\Traits\NotificationCheckStatus;
use Illuminate\Notifications\Messages\MailMessage;

class UptimeCheckRecovered extends \Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckRecovered
{
    use NotificationCheckStatus;

    public function getMessageText(): string
    {
        return "{$this->getDetailDomain()} has recovered after {$this->event->downtimePeriod->duration()}";
    }
}
