<?php

namespace App\Notifications\Certificate;

use App\Traits\NotificationCheckStatus;

class CertificateCheckSucceeded extends \Spatie\UptimeMonitor\Notifications\Notifications\CertificateCheckSucceeded
{
    use NotificationCheckStatus;

    public function getMessageText(): string
    {
        return "SSL certificate for {$this->getDetailDomain()} is valid";
    }
}
