<?php

namespace App\Notifications\Certificate;

use App\Traits\NotificationCheckStatus;

class CertificateExpiresSoon extends \Spatie\UptimeMonitor\Notifications\Notifications\CertificateExpiresSoon
{
    use NotificationCheckStatus;

    public function getMessageText(): string
    {
        return "SSL certificate for {$this->getDetailDomain()} expires soon";
    }
}
